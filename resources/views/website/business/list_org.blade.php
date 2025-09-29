@extends('frontend.template.master')

@section('content')

<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>business listing</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">business lising</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-body">
    <div class="container">
        <div class="row">
            <!-- <div class="col-md-11 col-lg-8 col-xl-6">
                <div class="card1">

                    <div class="card1-content ">
                        <div class="display-div1">
                            <div class="img-circle">
                                <img src="http://13.211.54.157/storage/profile_images/WYphPguDQ78TochrAQxe2CstiqNfTXbQXnQ8H3Nl.png">
                            </div>
                            <div>
                                <h4 class="oneline-overflow">Business Name</h4>
                                <h5 class="oneline-overflow">Business Type</h5>
                                <p class="oneline-overflow">Established: 2024</p>
                            </div>
                        </div>

                        <hr class="double-hr">


                        <div>
                            <p>Address: 401/402, Sneh Symphony, Opp. Vyom Labs, Laxman Nagar, Near Cummins Campus,
                                Balewadi City, Pune, Maharashtra, India 411045.</p>
                        </div>
                        <div>
                            <a href="#">Website URL: pharoscion.com</a>
                        </div>


                        <div class="section-break">
                            <section class="icon-container footer-container">

                                <a href="#" id="call" class="waves-effect waves-light btn icon-spacing">
                                    <i class="material-icons left">call</i></a>

                                <a href="#" id="email" class="waves-effect waves-light btn icon-spacing">
                                    <i class="material-icons left">email</i></a>

                                <a href="#" id="email" class="waves-effect waves-light btn icon-spacing">
                                    <i class="fa fa-eye"></i> view</a>

                            </section>
                        </div>
                    </div>

                </div>
            </div> -->
            <div class="col-lg-6">
                <div class="product-card standard">
                    <div class="product-media">
                        <div class="product-img recommend-product-img">
                            <img
                                src="http://13.211.54.157/storage/profile_images/WYphPguDQ78TochrAQxe2CstiqNfTXbQXnQ8H3Nl.png" alt="Product img">
                        </div>

                        <!-- <div class="cross-vertical-badge product-badge">
                            <i class="fas fa-clipboard-check"></i><span>recommend</span>
                        </div>
                        <div class="product-type"><span class="flat-badge sale">Sale</span></div>
                        <ul class="product-action">
                            <li class="view"><i class="fas fa-eye"></i><span>0</span></li>
                            <li class="click"><i class="fas fa-mouse"></i><span>150</span></li>
                            <li class="rating"><i class="fas fa-star"></i><span>5/5</span></li>
                        </ul> -->
                    </div>
                    <div class="product-content">
                        <!-- <ol class="breadcrumb product-category">
                            <li><i class="fas fa-tags"></i></li>
                            <li class="breadcrumb-item"><a
                                    href="http://13.211.54.157/categories/business-directory">Business Directory</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a
                                    href="http://13.211.54.157/post/business-directory/computer-electronics">Computer
                                    Electronics</a></li>
                        </ol> -->
                        <h5 class="product-title"><a href="#">Business Name
                            </a></h5>
                        <h5 class="product-title">Business Category
                        </h5>
                        <div class="product-meta"><span><i class="fas fa-map-marker-alt"></i>Address: 401/402, Sneh
                                Symphony, Opp. Vyom Labs, Laxman Nagar, Near Cummins Campus, Balewadi City, Pune,
                                Maharashtra, India 411045.</span>
                        </div>
                        <div class="product-meta">
                            <span><i class="fas fa-clock"></i>Established: 2024</span>
                        </div>
                        <div>
                            <a href="#">Website URL: pharoscion.com</a>
                        </div>
                        <div class="section-break">
                            <section class="icon-container footer-container">

                                <!-- <a href="#" id="call" class="waves-effect waves-light btn icon-spacing">
                                    <i class="material-icons left">call</i></a>

                                <a href="#" id="email" class="waves-effect waves-light btn icon-spacing">
                                    <i class="material-icons left">email</i></a> -->

                                <a href="#" id="email" class="waves-effect waves-light btn icon-spacing">
                                    <i class="fa fa-eye"></i> view</a>

                            </section>
                        </div>

                    </div>
                </div>



            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="footer-pagection">
                    <p class="page-info">Showing 12 of 60 Results</p>
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#"><i
                                    class="fas fa-long-arrow-alt-left"></i></a></li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">...</li>
                        <li class="page-item"><a class="page-link" href="#">67</a></li>
                        <li class="page-item"><a class="page-link" href="#"><i
                                    class="fas fa-long-arrow-alt-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<style>
    .section-body a {
        text-decoration: none;
        color: black;
    }

    .section-body {
        background-color: #fff;
        padding: 100px 0px;
    }

    .double-hr {
        border-top: 3px double #8c8b8b;
    }

    /* CARD SETUP STYLES */
    .card1 {
        background-color: #f5f5f5;
        width: 100%;
        margin: 1rem auto;
        /* -webkit-box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, 0.22); */
        transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 30px;
        background: #eee;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all linear .3s;
        -webkit-transition: all linear .3s;
        border-bottom: 3px solid #04b;
    }

    .card1:hover {
        -webkit-box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.1);
        transform: translateY(-0.5rem);
        background-color: #fff;
        box-shadow: 0px 10px 25px 0px rgba(0, 0, 0, 0.1);
        border-bottom: 5px solid #04b;
    }

    .display-div1 {
        display: flex;
        column-gap: 15px;
    }

    .img-circle img {
        width: 80px;
        height: auto;
        border-radius: 10px;
        background-clip: padding-box;
        background-size: cover;
        background-position: center center;
        text-align: center;
        margin: 0 auto;
    }

    /* 
@media only screen and (min-width: 737px) {
    .img-circle img {
        margin-left: 1rem;
        margin-right: 2rem;
    }
} */

    .oneline-overflow {
        overflow: auto;
    }

    @media only screen and (max-width: 737px) {
        .oneline-overflow {
            text-align: center;
        }
    }

    /* ICON CONTAINER STYLES */
    .section-break {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .icon-spacing {
        margin: 10px;
        padding: 10px;
        border: none;
        background: #0044bb;
        color: #fff ! IMPORTANT;
    }

    .icon-spacing:hover {
        background: #0022aa;

    }

    @media only screen and (max-device-width: 737px) {
        .icon-spacing {
            margin: 0.5em 0.5em 0.5em 0.5em;
        }
    }

    .icon-container {
        text-align: center;
        width: 100%;
    }

    .container-1 {
        margin-bottom: 1em;
    }

    /* SOCIAL MEDIA ICON COLORS */
    .facebook {
        background-color: #3b5998 !important;
        color: #fff !important;
    }

    .facebook i {
        color: #fff !important;
    }

    .facebook:hover {
        background-color: #4c70ba !important;
    }

    .github {
        background-color: #444444 !important;
        color: #fff !important;
    }

    .github i {
        color: #fff !important;
    }

    .github:hover {
        background-color: #5e5e5e !important;
    }

    .instagram {
        background-color: #405de6 !important;
        color: #fff !important;
    }

    .instagram i {
        color: #fff !important;
    }

    .instagram:hover {
        background-color: #6d83ec !important;
    }

    .linkedin {
        background-color: #007bb6 !important;
        color: #fff !important;
    }

    .linkedin i {
        color: #fff !important;
    }

    .linkedin:hover {
        background-color: #009de9 !important;
    }

    .twitter {
        background-color: #55acee !important;
        color: #fff !important;
    }

    .twitter i {
        color: #fff !important;
    }

    .twitter:hover {
        background-color: #83c3f3 !important;
    }
</style>

@endsection