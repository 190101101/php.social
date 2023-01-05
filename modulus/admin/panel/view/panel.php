<?php breadcump();  ?>
<div class="row">
    <?php $main = new core\controller; ?>
    <?php $main->view('admin', 'requires', 'admin/sidebar', []); ?>  

    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->user; ?> Users</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, quam.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->guest; ?> Guests</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores, quam.</p>
                    </div>
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
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->contact; ?> contact</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, sit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->rule; ?> rule</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, iure?</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->faq; ?> faq</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, iure?</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 portfolio-item">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">
                            <a><?php echo $data->setting; ?> setting</a>
                        </h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, iure?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>