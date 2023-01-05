<h3 class="mt-4 mb-3">404
    <small>Page Not Found</small>
</h3>

<?php breadcump();  ?>

<div class="jumbotron">
    <h1 class="display-1">404</h1>
    <p>The page you're looking for could not be found. Here are some helpful links to get you back on track:</p>
    <ul>
        <li>
            <a href="/">Home</a>
        </li>
        <?php if(User::has()): ?>
        <li>
            profile
            <ul>
                <li>
                    <a href="/profile/info/page/1">profile</a>
                </li>
                <li>
                    <a href="/profile/update">update</a>
                </li>
            </ul>
        </li>
        <?php endif; ?>
        <li>
            Other Pages
            <ul>
                <li>
                    <a href="/info/rule/page/1">Rule</a>
                </li>
                <li>
                    <a href="/info/faq/page/1">FAQ</a>
                </li>
                <li>
                    <a href="/contact">Contact</a>
                </li>
                <li>
                    <a href="/info/about">About</a>
                </li>
                <li>
                    <a href="/404">404 Page</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
