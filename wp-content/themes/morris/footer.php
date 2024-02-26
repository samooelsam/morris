<footer class="footer-wrapper clearfix">
    <div class="top-footer clearfix">
        <div class="centerize grid_12 clearfix">
            <div class="column grid_3 footer-column">
                <h3>Brands</h3>
                <div class="brands clearfix">
                    <div class="column image-wrapp clearfix">
                       <img src="<?php echo(bloginfo('template_directory'))?>/img/HILTA-f.svg" />
                    </div>
                    
                    <div class="column image-wrapp ital clearfix">
                        <img src="<?php echo(bloginfo('template_directory'))?>/img/arcgen.svg" />
                    </div>
                    <div class="column full image-wrapp clearfix">
                        <img src="<?php echo(bloginfo('template_directory'))?>/img/Ital-Tower.svg" />
                        
                    </div>
                    <div class="column image-wrapp clearfix">
                        <img src="<?php echo(bloginfo('template_directory'))?>/img/denyo.svg" />
                    </div>
                    <div class="column image-wrapp clearfix">
                        <img src="<?php echo(bloginfo('template_directory'))?>/img/aem.svg" />
                    </div>
                </div>
            </div>

            <div class="column grid_3 footer-column footer-left-padding">
                <h3><?php _e('More information', 'morris');?></h3>
                <div class="links clearfix">
                    <ul>
                        <?php dynamic_sidebar('footer-nav'); ?>
                    </ul>
                </div>
            </div>
            <div class="column grid_3 footer-column footer-left-padding">
                <h3>Products</h3>
                <div class="links clearfix">
                    <ul>
                        <?php dynamic_sidebar('footer-products'); ?>
                    </ul>
                </div>
            </div>
            <div class="column grid_3 footer-column">
                 <h3>Keep in touch</h3>
                <div class="intouch clearfix">
                    <p><a href="https://www.morrismachinery.co.uk/contact">Contact</a></p>
                <?php   $tel = get_option('company_tel');
                        $email = get_option('company_email');
                        $address = get_option('company_address');  
                        if($email) {?>
                            <p><?php echo($email);?></p>
                    <?php } if($tel) {?>
                          <p><?php echo($tel);?></p>
                    <?php }
                    if($address) {?>
                       <p><?php echo($address);?></p>
                    <?php }?>
                    
                </div>
                <div class="map clearfix">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2415.8357102385958!2d-2.7318109226648204!3d52.73515697211843!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48709dc555555555%3A0x1d95e1e3e70f47a6!2sMorris%20Machinery!5e0!3m2!1sen!2sde!4v1689603568336!5m2!1sen!2sde" width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="down-footer clearfix">
        <div class="centerize clearfix">
            <div class="jfh-logo clearfix">
                <a href="https://www.johnfhunt.co.uk" target="_blank">
                    <img src="<?php echo(bloginfo('template_directory'))?>/img/JohnFHunt.svg" />
                </a>
                <span>Part of the <br> John F Hunt Group</span>
            </div>
            <p>All rights reserved © Morris  Machinery <?php echo(date('Y'));?></p>
            <div class="techvertu-licence clearfix">
                <ul class="social-media">
                    <li>
                        <a href="https://www.facebook.com/Morrismachinery/?locale=en_GB" target="_blank">
                            <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.61811 11.4404V6.2223H6.36893L6.6316 4.1881H4.61811V2.88955C4.61811 2.30079 4.78094 1.89955 5.62618 1.89955L6.70247 1.89911V0.0796427C6.51634 0.0554549 5.87743 0 5.1338 0C3.58099 0 2.51791 0.947821 2.51791 2.68809V4.1881H0.761787V6.2223H2.51791V11.4404H4.61811Z" fill="white"/>
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="https://uk.linkedin.com/company/morris-site-machinery" target="_blank">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.8809 11.4406V7.25051C11.8809 5.19123 11.4376 3.61816 9.03511 3.61816C7.87677 3.61816 7.10454 4.24739 6.78992 4.84801H6.76132V3.80407H4.48753V11.4406H6.86143V7.65092C6.86143 6.64988 7.04733 5.69175 8.27718 5.69175C9.49273 5.69175 9.50703 6.82149 9.50703 7.70812V11.4263H11.8809V11.4406Z" fill="white"/>
                                <path d="M0.626358 3.80396H3.00025V11.4405H0.626358V3.80396Z" fill="white"/>
                                <path d="M1.8133 0C1.05537 0 0.440445 0.614924 0.440445 1.37285C0.440445 2.13078 1.05537 2.76001 1.8133 2.76001C2.57123 2.76001 3.18615 2.13078 3.18615 1.37285C3.18615 0.614924 2.57123 0 1.8133 0Z" fill="white"/>
                            </svg>
                        </a>
                    </li>
                </ul>
                <span>Web and IT Support - <a rel="nofollow" target="_blank" href="https://www.techvertu.co.uk">TechVertu</a></span>
            </div>
        </div>
    </div>
</footer>
<div class="blur-overlay clearifx">
    
</div>


<?php wp_footer();?>
</body>
</html>