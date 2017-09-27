<?php

namespace Guni\Comments;

/**
 * Comments to generate HTML for the reports page.
 */
class Comments implements
    \Anax\Common\ConfigureInterface,
    \Anax\Common\AppInjectableInterface
{
    use \Anax\Common\ConfigureTrait,
        \Anax\Common\AppInjectableTrait;


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
        $array = $this->app->rem->getDataset('comments');
        $path = $this->app->request->getBaseUrl();
        $i = 3;
        foreach ($array as $val) {
            $headline = $val['headline'];
            $comment = $val['comment'];
            $email = $val['email'];
            $id = $val['id'];
            $a = $this->app->textfilter->parse($comment, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            //var_dump($a);
            $i .= 1;
            $this->app->view->add("view/blog", [
                "content" => $a->text,
                "email" => "<a href = '$path/update'>" . $email . "</a>",
                "headline" => $headline,
                "id" => $id,
                "gravatar" => $this->getGravatar($email)], "mainright", ($i));
        }
    }

    public function getCommFromJson()
    {
        $path = ANAX_APP_PATH . "/config/remserver/comments.json";
        $content = json_decode(file_get_contents($path));
        //var_dump($content);
        foreach ($content as $key => $value) {
            $a = $this->app->textfilter->parse($value->comment, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            $this->app->view->add("view/blog", [
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
        //var_dump($this->app->rem->getItem('comments', (int)$idLink));
        $content = isset($idLink) && null !== $this->app->rem->getItem('comments', (int)$idLink) ? $this->app->rem->getItem('comments', (int)$idLink) : null;
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
        if (!isset($_SESSION)) {
            session_start();
        }
        $form = $this->createForm($komm);
        //var_dump($this->app->rem->getDataset('comments'));

        $this->app->view->add("default1/article", [
            "content" => $form], "mainleft", 0);

        $mdFiles = $this->getComments();
        foreach ($mdFiles as $key => $value) {
            $a = file_get_contents(ANAX_APP_PATH . "/content/comments/" . $value);
                //var_dump($a);
            $filtered = $this->app->textfilter->parse($a, ["yamlfrontmatter", "shortcode", "markdown", "titlefromheader"]);
            //var_dump($a, $filtered);
            $this->app->view->add("view/blog", [
                    "content" => $filtered->text], "mainright", ($key + 1));
        }
    }


    public function inValidate()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        //var_dump($this->app->request->getBody());
        $com = $this->app->request->getPost("text_box");
        $send = $this->app->request->getPost("comment");
        //var_dump($com);
        $this->save($send, $com);

        $del = $this->app->request->getPost("delete");
        $id = $this->app->request->getPost("id");
        //var_dump($del);
        $this->delete($del, $id);

        $seeId = $this->app->request->getPost("see");
        //var_dump($update);
        $this->show($seeId, $id);

        $update = $this->app->request->getPost("update");
        //var_dump($update);
        $this->update($update, $id);
    }


    /**
     * Send posted content to funcion sessionSave
     */
    public function save($send = null, $com = null)
    {
        if ($send == "Spara" && ctype_space($com) == false && $com !== "" && $com !== null) {
            $this->sessionSave(
                array(
                    'email' => $this->app->request->getPost("email"),
                    'headline' => $this->app->request->getPost("headline"),
                    'comment' => $this->app->request->getPost("text_box")
                )
            );
            $this->app->redirect('commpage');
        }
    }


    /**
    * send content to be deleted to remserver
    *
    */
    public function delete($del = null, $id = null)
    {
        if ($del == "Släng" && ctype_space($id) == false && $id !== "" && $id !== null) {
            $this->app->rem->deleteItem('comments', $id);
            $this->app->redirect('commpage');
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
        if ($update == "Ändra" && ctype_space($id) == false && $id !== "" && $id !== null) {
            $entry = array(
                    'email' => $this->app->request->getPost("email"),
                    'headline' => $this->app->request->getPost("headline"),
                    'comment' => $this->app->request->getPost("text_box")
                );
            $this->app->rem->deleteItem('comments', $id);
            $this->app->rem->upsertItem('comments', $id, $entry);
            $this->app->redirect('commpage');
        }
    }



    /**
     * Send content array to be saved in session
     * Send content array to be saved in json-file
     */
    public function sessionSave($array)
    {
        $key = 'comments';
        var_dump($array);
        $this->app->rem->addItem($key, $array);
        //$this->app->rem->saveToFile($key, $array);
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
