<!DOCTYPE html>
<html>
<head>
    <title><?php
                if (is_home()) {
                    echo (bloginfo('name'));
                    echo (" | ");
                    echo (bloginfo('description'));
                } else {
                    $pagetitle = get_post(get_the_ID());
                    if ($pagetitle->post_type == "articles" || $pagetitle->post_type == "post") {
                        wp_title('');
                        echo (" | ");
                        echo (bloginfo('name'));
                    } else {

                        wp_title('|');
                    }
                }
                ?></title>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
    
    <link rel="shortcut icon" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <link rel="icon" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png" type="image/png">
    <link rel="shortcut icon" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <link rel="apple-touch-icon" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo(bloginfo('template_directory'));?>/img/favicon-1.png">
    <meta name="format-detection" content="telephone=no">
    <?php wp_head(); ?>
</head>
<?php $tel = get_option('company_tel');
      $email = get_option('company_email');
      $logo = get_option('image_url');  
      (is_user_logged_in()) ? $loggeClass = 'logged-in-user' : $loggeClass = '';?>
<body class='<?php echo($loggeClass);?>'>
    <header class="header-wrapper clearfix">
        <div class="top-header clearfix">
            <div class="gird_12 clearfix centerize">
                <div class="grid_6 column clearfix">
                    <nav class="more-info inline-nav clearfix">
                        <ul>
                            <?php /*
                            <li><a>Built to Perform</a>
                               <img src="<?php echo(bloginfo('template_directory'))?>/img/united-kingdom.svg" />
                            </li> */?>
                            <?php if($email) {?>
                            <li>
                                <svg width="13" height="14" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_616_1777)">
                                    <path d="M10.1899 1.53125H2.68154C1.97061 1.5321 1.28905 1.81489 0.786344 2.3176C0.283641 2.8203 0.000847768 3.50187 -3.8147e-06 4.2128L-3.8147e-06 10.6485C0.000847768 11.3594 0.283641 12.041 0.786344 12.5437C1.28905 13.0464 1.97061 13.3292 2.68154 13.3301H10.1899C10.9008 13.3292 11.5824 13.0464 12.0851 12.5437C12.5878 12.041 12.8706 11.3594 12.8714 10.6485V4.2128C12.8706 3.50187 12.5878 2.8203 12.0851 2.3176C11.5824 1.81489 10.9008 1.5321 10.1899 1.53125V1.53125ZM2.68154 2.60387H10.1899C10.511 2.6045 10.8246 2.70122 11.0903 2.88157C11.356 3.06193 11.5617 3.31767 11.6808 3.61589L7.57376 7.72348C7.27151 8.02452 6.8623 8.19354 6.43571 8.19354C6.00912 8.19354 5.59991 8.02452 5.29766 7.72348L1.1906 3.61589C1.30974 3.31767 1.5154 3.06193 1.78111 2.88157C2.04681 2.70122 2.36041 2.6045 2.68154 2.60387V2.60387ZM10.1899 12.2574H2.68154C2.25483 12.2574 1.84559 12.0879 1.54386 11.7862C1.24213 11.4845 1.07262 11.0752 1.07262 10.6485V5.01726L4.53932 8.48182C5.04272 8.98394 5.7247 9.26593 6.43571 9.26593C7.14672 9.26593 7.82871 8.98394 8.3321 8.48182L11.7988 5.01726V10.6485C11.7988 11.0752 11.6293 11.4845 11.3276 11.7862C11.0258 12.0879 10.6166 12.2574 10.1899 12.2574Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_616_1777">
                                    <rect width="12.8714" height="12.8714" fill="white" transform="translate(0 0.995117)"/>
                                    </clipPath>
                                    </defs>
                                </svg>

                                

                                <a href="mailto:<?php echo($email);?>"><?php echo($email)?></a></li>
                            <?php } if($tel) { ?>
                            <li>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_616_1774)">
                                    <path d="M7.51493 1.53131C7.51493 1.38907 7.57144 1.25266 7.67201 1.15208C7.77259 1.0515 7.909 0.994997 8.05124 0.994997C9.47314 0.996559 10.8364 1.5621 11.8418 2.56754C12.8472 3.57297 13.4128 4.93619 13.4143 6.35809C13.4143 6.50033 13.3578 6.63674 13.2572 6.73732C13.1567 6.8379 13.0203 6.8944 12.878 6.8944C12.7358 6.8944 12.5994 6.8379 12.4988 6.73732C12.3982 6.63674 12.3417 6.50033 12.3417 6.35809C12.3404 5.22058 11.888 4.13002 11.0836 3.32568C10.2793 2.52133 9.18875 2.06889 8.05124 2.06762C7.909 2.06762 7.77259 2.01111 7.67201 1.91053C7.57144 1.80996 7.51493 1.67354 7.51493 1.53131ZM8.05124 4.21285C8.62019 4.21285 9.16584 4.43887 9.56815 4.84118C9.97046 5.24349 10.1965 5.78914 10.1965 6.35809C10.1965 6.50033 10.253 6.63674 10.3536 6.73732C10.4541 6.8379 10.5905 6.8944 10.7328 6.8944C10.875 6.8944 11.0114 6.8379 11.112 6.73732C11.2126 6.63674 11.2691 6.50033 11.2691 6.35809C11.2682 5.50493 10.9289 4.68695 10.3257 4.08366C9.72239 3.48038 8.90441 3.14109 8.05124 3.14024C7.909 3.14024 7.77259 3.19674 7.67201 3.29732C7.57144 3.39789 7.51493 3.53431 7.51493 3.67654C7.51493 3.81878 7.57144 3.9552 7.67201 4.05577C7.77259 4.15635 7.909 4.21285 8.05124 4.21285ZM12.9279 9.97228C13.2387 10.2839 13.4132 10.7061 13.4132 11.1463C13.4132 11.5864 13.2387 12.0086 12.9279 12.3202L12.4399 12.8828C8.04749 17.088 -2.64115 6.40207 1.49915 1.99575L2.11591 1.45944C2.42792 1.15733 2.84633 0.990197 3.28061 0.994211C3.7149 0.998226 4.13015 1.17306 4.43652 1.48089C4.45314 1.49752 5.44692 2.78842 5.44692 2.78842C5.7418 3.0982 5.90595 3.50971 5.90525 3.93741C5.90456 4.3651 5.73906 4.77607 5.44317 5.08489L4.82212 5.86576C5.16582 6.70085 5.67114 7.4598 6.30905 8.099C6.94696 8.7382 7.70488 9.24505 8.53928 9.59043L9.32497 8.96563C9.63384 8.66997 10.0447 8.50467 10.4723 8.50407C10.8999 8.50347 11.3112 8.66762 11.6209 8.96241C11.6209 8.96241 12.9113 9.95566 12.9279 9.97228ZM12.1899 10.7521C12.1899 10.7521 10.9065 9.76473 10.8899 9.7481C10.7794 9.63855 10.6301 9.57709 10.4746 9.57709C10.319 9.57709 10.1697 9.63855 10.0592 9.7481C10.0447 9.76312 8.96297 10.625 8.96297 10.625C8.89007 10.683 8.80331 10.721 8.71125 10.7353C8.61918 10.7496 8.52498 10.7397 8.43792 10.7065C7.35697 10.304 6.37513 9.67395 5.55892 8.85895C4.74271 8.04394 4.11119 7.06304 3.70714 5.98268C3.67131 5.89443 3.65963 5.79823 3.6733 5.70398C3.68697 5.60972 3.72549 5.5208 3.7849 5.44637C3.7849 5.44637 4.64675 4.36409 4.66123 4.35015C4.77078 4.23966 4.83225 4.09037 4.83225 3.93478C4.83225 3.77919 4.77078 3.62989 4.66123 3.51941C4.64461 3.50332 3.65726 2.21886 3.65726 2.21886C3.54512 2.1183 3.39876 2.06445 3.24819 2.06834C3.09762 2.07223 2.95424 2.13356 2.84744 2.23977L2.23068 2.77608C-0.795175 6.4144 8.46742 15.1632 11.6558 12.1502L12.1443 11.5871C12.2588 11.4811 12.3276 11.3346 12.3361 11.1788C12.3446 11.023 12.2922 10.87 12.1899 10.7521Z" fill="white"/>
                                    </g>
                                    <defs>
                                    <clipPath id="clip0_616_1774">
                                    <rect width="12.8714" height="12.8714" fill="white" transform="translate(0.542969 0.995117)"/>
                                    </clipPath>
                                    </defs>
                                </svg>
                                <a href="tel:<?php echo($tel);?>"><?php echo($tel);?></a></li>
                            <?php }?>
                        </ul>
                    </nav>
                </div>
                <div class="grid_6 column clearfix">
                    <nav class="top-nav-links inline-nav clearfix">
                    <?php wp_nav_menu( array('theme_location' => 'topspot'));?>
                    </nav>
                </div>
            </div>
        </div>
        <div class="down-header clearfix">
        <?php get_template_part('includes/searchform', 'searchform');?>
            <div class="grid_12 clearfix centerize">
                <div class="grid_2 column middle clearfix">
                    <a href="<?php echo(home_url());?>" class="logo">
                        <?php if($logo) {?>
                            <img src="<?php echo($logo);?>" />
                        <?php }?>
                    </a>
                </div>
                <div class="grid_10 column middle clearfix">
                    <div class="left-menu-holder clearfix">
                        <nav class="main-nav-links inline-nav clearfix">
                            <span class="mobile-menu">
                                <i class="fi fi-rr-menu-burger"></i>
                            </span>
                            
                            <?php wp_nav_menu( array('theme_location' => 'topnav'));?>
                        </nav>
                        <span class="search-icn">
                            <i class="fi fi-rr-search"></i>
                            
                        </span>
                        
                        <span class="shop-icn">
                            <?php $cartItemNumber = WC()->cart->get_cart_contents_count();
                            if($cartItemNumber){?>
                                  <span class="red-bubble"><?php echo( $cartItemNumber );?></span>
                            <?php }?>
                            <i class="fi fi-rr-shopping-bag"></i>
                            <?php get_template_part('includes/cartheader', 'cartheader');?>
                        </span>
                    </div>
                </div>
            </div>
           
        </div>
    </header>