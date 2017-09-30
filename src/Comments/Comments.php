<?php

namespace Guni\Comments;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;

/**
 * Comments to generate HTML for the reports page.
 */
class Comments implements
    \Anax\Common\ConfigureInterface,
    //\Anax\Common\AppInjectableInterface
    InjectionAwareInterface
{
    use InjectionAwareTrait, \Anax\Common\ConfigureTrait;
        //\Anax\Common\AppInjectableTrait;


    /**
     * @var array $session inject a reference to the session.
     */
    private $session;



    /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }

    public function getComments()
    {
        $dir = ANAX_APP_PATH . "/content/comments/";
        $i = 0;
        $array = [];
        if ($handle = opendir($dir)) {
            while (($file = readdir($handle)) !== false) {
                if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) {
                    array_push($array, $file);
                    $i++;
                }
            }
        }
        return $array;
    }

    public function getCommFromSess()
    {
        $rem = $this->di->get("rem");
        $request = $this->di->get("request");
        $textfilter = $this->di->get("textfilter");
        $view = $this->di->get("view");

        $array = $rem->getDataset('comments');
        $path = $request->getBaseUrl();
        $i = 0;
        foreach ($array as $val) {
            $headline = $val['headline'];
            $comment = $val['comment'];
            $email = $val['email'];
            $id = $val['id'];
            $a = $textfilter->parse($comment, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            //var_dump($a);
            $i .= 1;
            $view->add("view/blog", [
                "content" => $a->text,
                "email" => "<a href = '$path/update'>" . $email . "</a>",
                "headline" => $headline,
                "id" => $id,
                "gravatar" => $this->getGravatar($email)], "mainright", ($i));
        }
    }

    public function getCommFromJson()
    {
        $textfilter = $this->di->get("textfilter");
        $view = $this->di->get("view");

        $path = ANAX_APP_PATH . "/config/remserver/comments.json";
        $content = json_decode(file_get_contents($path));
        //var_dump($content);
        foreach ($content as $key => $value) {
            $a = $textfilter->parse($value->comment, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            $view->add("view/blog", [
                "content" => $a->text,
                "email" => $value->email,
                "headline" => $value->headline,
                "gravatar" => $this->getGravatar($value->email)], "mainright", ($key + 1));
        }
    }


    /**
    * Create a form
    *
    * @return form
    */
    public function createForm($idLink = null)
    {
        $rem = $this->di->get("rem");

        //var_dump($rem->getItem('comments', (int)$idLink));
        $content = isset($idLink) && null !== $rem->getItem('comments', (int)$idLink) ? $rem->getItem('comments', (int)$idLink) : null;
        $headl = isset($content['headline']) ? $content['headline'] : null;
        $eml = isset($content['email']) ? $content['email'] : null;
        $txt = isset($content['comment']) ? $content['comment'] : null;

        $form = "<h4>Gör så här:</h4>";
        $form .= "<ul><li>Skriv nytt: Inget id. Klicka Spara</li>";
        $form .= "<li>Ändra:<br />Välj ditt id. Klicka Ettid<br />
        Uppdatera din post. Klicka Ändra</li>";
        $form .= "<li>Släng: Välj ditt id. Klicka Släng</li>";
        $form .= "</ul>";

        $form .= "<form name='form' action='validate' method='post'>
        Id:<br /><input type='text' name='id' value='";
        $form .= $idLink;
        $form .= "'><br />
        <span class='textareaLayout'>
        <label for = 'content'>Innehåll:<br />
        <textarea name='text_box' rows='10' cols='60'>";
        $form .= $txt;
        $form .= "</textarea><br />
        Rubrik:<br />
        <input type='text' name='headline' value='";
        $form .= $headl;
        $form .= "'><br />Email:<br />
        <input type='text' name='email' value='";
        $form .= $eml;
        $form .= "'><input type='submit' name='comment' id='comment-submit' value='Spara' />
        <input type='submit' name='delete' id='delete-submit' value='Släng' />
        <input type='submit' name='see' id='see-submit' value='EttId' />
        <input type='submit' name='update' id='update-submit' value='Ändra' />
        </form>";
        return $form;
    }



    /**
     * Create a form
     * Get all comments
     * Send to view
     */
    public function addComment($komm = null)
    {
        $view = $this->di->get("view");        

        if (!isset($_SESSION)) {
            session_start();
        }
        $form = $this->createForm($komm);

        $view->add("default1/article", [
            "content" => $form], "mainleft", 0);

        /*
        $rem = $this->di->get("rem");
        //var_dump($rem->getDataset('comments'));
        $textfilter = $this->di->get("textfilter");
        $mdFiles = $this->getComments();
        foreach ($mdFiles as $key => $value) {
            $a = file_get_contents(ANAX_APP_PATH . "/content/comments/" . $value);
                //var_dump($a);
            $filtered = $textfilter->parse($a, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            //var_dump($a, $filtered);
            $view->add("view/blog", [
                    "content" => $filtered->text], "mainright", ($key + 1));
        }*/
    }


    public function inValidate()
    {
        $request = $this->di->get("request");

        if (!isset($_SESSION)) {
            session_start();
        }
        //var_dump($request->getBody());
        $com = $request->getPost("text_box");
        $send = $request->getPost("comment");
        //var_dump($com);
        $this->save($send, $com);

        $del = $request->getPost("delete");
        $id = $request->getPost("id");
        //var_dump($del);
        $this->delete($del, $id);

        $seeId = $request->getPost("see");
        //var_dump($update);
        $this->show($seeId, $id);

        $update = $request->getPost("update");
        //var_dump($update);
        $this->update($update, $id);
    }


    /**
     * Send posted content to funcion sessionSave
     */
    public function save($send = null, $com = null)
    {
        $request = $this->di->get("request");
        $response = $this->di->get("response");

        if ($send == "Spara" && ctype_space($com) == false && $com !== "" && $com !== null) {
            $this->sessionSave(
                array(
                    'email' => $request->getPost("email"),
                    'headline' => $request->getPost("headline"),
                    'comment' => $request->getPost("text_box")
                )
            );
            $response->redirect('commpage');
        }
    }


    /**
    * send content to be deleted to remserver
    *
    */
    public function delete($del = null, $id = null)
    {
        $rem = $this->di->get("rem");
        $response = $this->di->get("response");

        if ($del == "Släng" && ctype_space($id) == false && $id !== "" && $id !== null) {
            $rem->deleteItem('comments', $id);
            $response->redirect('commpage');
        };
    }


    /**
    * Show a post in form
    *
    */
    public function show($show = null, $id = null)
    {
        if ($show == "EttId" && ctype_space($id) == false && $id !== "" && $id !== null) {
            $this->addComment($id);
        }
    }


    /**
    * send content to be updated to remserver
    *
    */
    public function update($update = null, $id = null)
    {
        $request = $this->di->get("request");
        $rem = $this->di->get("rem");
        $response = $this->di->get("response");

        if ($update == "Ändra" && ctype_space($id) == false && $id !== "" && $id !== null) {
            $entry = array(
                    'email' => $request->getPost("email"),
                    'headline' => $request->getPost("headline"),
                    'comment' => $request->getPost("text_box")
                );
            $rem->deleteItem('comments', $id);
            $rem->upsertItem('comments', $id, $entry);
            $response->redirect('commpage');
        }
    }



    /**
     * Send content array to be saved in session
     * Send content array to be saved in json-file
     */
    public function sessionSave($array)
    {
        $rem = $this->di->get("rem");

        $key = 'comments';
        var_dump($array);
        $rem->addItem($key, $array);
        //$rem->saveToFile($key, $array);
    }


    /**
     * param email-address
     * @return url for a gravatar image.
     */
    public function getGravatar($email, $size = 30, $dim = 'mm', $rad = 'g', $img = false, $atts = array())
    {
        $url = 'https://www.gravatar.com/avatar/';
        $url .= md5(strtolower(trim($email)));
        $url .= "?s=$size&d=$dim&r=$rad";
        if ($img) {
            $url = '<img src="' . $url . '"';
            foreach ($atts as $key => $val) {
                $url .= ' ' . $key . '="' . $val . '"';
            }
            $url .= ' />';
        }
        return $url;
    }
}
