<!-- 
<?php $article = $data->article; ?>
<h3 class="mt-4 mb-3">#<?php echo $article->article_title; ?></h3>
 -->
<?php $article = $data->article; ?>
<h3 class="mt-4 mb-3">#<?php echo $article->article_title; ?>
    <small>by
        <a class="text-danger">@<?php echo $article->user_login; ?></a>
    </small>
</h3>

<?php breadcump();  ?>
<div class="row">
    <div class="col-lg-8">
        <p class="lead"><?php echo $article->article_text; ?></p>
        <hr>

        <div class="my-3">

            <span>
                <span class="badge badge-warning">
                    Nəşr edilmişdir: <?php echo $article->article_created; ?>
                </span>
            </span>

             <span class="badge badge-primary">baxış: <?php echo $article->article_view; ?></span>
        </div>

        <?php if(User::has() && User::user_id() != $article->user_id): ?>
          <details title='click me' open>
            <summary>
                <span>
                    <span>yaz</span>
                </span>
            </summary>
                <div class="row">
                    <form action="/comment/create" method="POST" class="col-md-12">
                        <div class="form-group">
                            <textarea name="comment_text" minlength="2" maxlength="500" type="text" class="form-control" placeholder="comment text" required></textarea>
                            <input type="hidden" name="article_id" value="<?php echo $article->article_id; ?>">
                        </div>
                        <div class="form-group" style="width: 100%;">
                            <button style="width: 100%;" class="btn btn-success">send</button>
                        </div>
                    </form>
                </div>
            </details>
        <?php endif; ?>

    </div>
    <div class="col-md-4">
        <?php if(User::has()): ?>
        <div class="card mb-3">
            <h5 class="card-header">axtar</h5>
            <div class="card-body">
                <form action="/article/search/key/value">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">#</span>
                        </div>
                        <input type="text" class="form-control" name="field_value" minlength="3" maxlength="20" placeholder="Search for..." required>
                        <span class="input-group-btn">
                        <button class="btn btn-secondary ml-1" type="submmit">Go!</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <?php if(count($data->similar) > 1): ?>
        <div class="card ">
            <h5 class="card-header">oxşar</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <?php foreach($data->similar[0] as $similar): ?>
                            <li>
                                <a href="/article/read/<?php echo $similar->article_id; ?>/page/1">
                                #<?php echo $similar->article_id; ?>
                                <?php echo substr($similar->article_text, 0, 7); ?>...
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <ul class="list-unstyled mb-0">
                            <ul class="list-unstyled mb-0">
                                <?php foreach($data->similar[1] as $similar): ?>
                                <li>
                                    <a href="/article/read/<?php echo $similar->article_id; ?>/page/1">
                                    #<?php echo $similar->article_id; ?>
                                    <?php echo substr($similar->article_text, 0, 7); ?>...
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="card my-3">
            <h5 class="card-header"><?php echo Setting::reminder_title(); ?></h5>
            <div class="card-body">
                <?php echo Setting::reminder(); ?>
            </div>
        </div>
    </div>
</div>
