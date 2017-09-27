---
title: "Artiklar"
titleBreadcrumb: Borta

views:
    img:
        region: sidebar-left
        template: default/image
        data:
            src: "img/gunvor.jpg"
            
    side-pull-right:
        region: sidebar-right
        template: default/article
        sort: 1
        data:
            class: pull-right
            meta:
                type: content
                route: regions/side-pull-right

    side-right:
        region: sidebar-right
        template: default/article
        sort: 1
        data:
            meta:
                type: content
                route: regions/side-right
...
Artiklar
=========================

Artiklarna