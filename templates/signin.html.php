<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    
        <form class="signin-form" action="/login" method="post">
            <h1>Sign In</h1>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" value="<?= $request->post->get('username', '') ?>" id="username" name="username">

                <?php if ($errors->has('username')): ?>
                    <div class="error-message">
                        <?php echo $errors->get('username'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">


                <?php if ($errors->has('password')): ?>
                    <div class="error-message">
                        <?php echo $errors->get('password'); ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <button type="submit">Sign In</button>
            </div>


        </form>


    </body>
</html>
