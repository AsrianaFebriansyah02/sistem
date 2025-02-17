<?php $this->load->view('template/header'); ?>
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active"><?php echo $title ?></li>
                            </ol>
                        </div>
                        <h4 class="page-title"><?php echo $title ?></h4>
                    </div>
                </div>
            </div>
            <?php $this->load->view($content_view); ?>
        </div>
        <?php $this->load->view('template/footer'); ?>