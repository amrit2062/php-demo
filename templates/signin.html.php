<?php require_once TEMPLATE_PATH . 'common/header.html.php' ?>

<section class="page-section" id="contact">
            <div class="container">
                <!-- Contact Section Heading-->
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Login</h2>
                <!-- Icon Divider-->
                <!-- Contact Section Form-->
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        <form  method="post" action="/login">
                            <!-- Name input-->
                            
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" value="<?= $request->post->get('username', '') ?>"  id="email" type="text" placeholder="name@example.com" name="username" />
                                <label for="email">Email address</label>
                                
                                <?php if ($errors->has('username')): ?>
                                    <div class="error-message">
                                        <?php echo $errors->get('username'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Password address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" type="password" placeholder="Enter your password" name="password" />
                                <label for="password">Password</label>
                                
                                <?php if ($errors->has('password')): ?>
                                    <div class="error-message">
                                        <?php echo $errors->get('password'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Submit Button-->
                            <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

<?php require_once TEMPLATE_PATH . 'common/footer.html.php' ?>