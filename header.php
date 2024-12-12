<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="<?php bloginfo('description')?>">
    <title><?php bloginfo('name')?></title>
    <?php wp_head();?>
</head>
<body>
    <header id="main-header" class="py-1 my-1">
        <div class="container bg-white text-center">
            <h1>
                <a href="<?php echo site_url();?>" class="website-title">
                <?php bloginfo('name')?>
                </a>
            </h1>
            <?php wp_nav_menu(array('theme_location'=>'main-menu') ) ?>
        </div>

    </header>









<!-- Home

Blogger

Home page

page test

Sample Page

who are we -->