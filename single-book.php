<?php get_header() ?>
<section id="main">
    <div class="container-90">
        <div class="d-grid-7-3">
            <div class="content">


                <?php if (have_posts()):  ?>
                    <?php while (have_posts()):  ?>
                        <?php if (the_post());  ?>

                        <div class="book text-center d-grid-2-8">
                            <div class="book-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                            <div class="container mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;padding-bottom: 50px;">Title</th>
                                        <th style="width: 80%;"><h1><?php the_title()?></h1></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Description</td>
                                        <td><?php the_excerpt()?></td>
                                    </tr>
                                    <tr>
                                        <td>Book Type</td>
                                        <td>
                                            <?php the_terms($post->ID, 'book_type', '', ' - ', '' ) ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Writer</td>
                                        <td><?php the_terms($post->ID, 'writer', '', ' - ', '' ) ?></td>
                                    </tr>
                                    <tr>
                                        <td>Publisher</td>  
                                        <td><?php the_terms($post->ID, 'publisher', '', ' - ', '' ) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            
                        </div>

                    <?php endwhile;  ?>
                <?php endif; ?>

            </div>
            <?php get_sidebar('book'); ?>

        </div>
    </div>
</section>
<?php get_footer() ?>