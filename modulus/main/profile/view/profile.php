<?php breadcump();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('main', 'requires', 'main/sidebar'); ?>  

    <div class="col-md-9">
        <div class="row">
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <a href="/profile/update" class="card-body">
                        <h4 class="card-title">profili yenile</h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, odit?</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->article; ?> Articles</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Culpa, odit?</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->comment; ?> Comments</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum, aliquam.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>