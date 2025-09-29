@extends('frontend.template.master')

@section('content')

<style>
    .section-1 {
        background: #f5f5f5;
        padding: 75px 40px;
    }

    .section-1 .nav-pills {
        background: #fff;
        justify-content: flex-start;
        align-items: normal;
    }

    .section-1 .nav-pills button {
        padding: 10px 15px;
        border-bottom: 1px solid #bbb;
        width: 100%;
        text-align: left;
        display: block;
        padding: 1.25rem 1rem 1rem;
        line-height: 1;
        font-weight: 500;
        font-size: 14px;
    }

    .nav-pills .nav-link {
        font-size: 14px;
        color: #000;
        padding: 6px 1rem;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        background-color: transparent;
        color: #007bff;
        font-size: 14px;
    }

    .tab-pane {
        padding: 20px;
    }

    .card-header {
        margin-bottom: 0px;
        padding: 0px 0px 10px;
    }

    .card-header h5 {
        font-size: 16px;
    }

    .card-body {
        font-size: 14px;
    }

    .card-body ol,
    .card-body ul {
        list-style: auto;
    }

    .card-body ol li,
    .card-body ul li {
        margin-bottom: 10px;
    }

    .account-title::before,
    .card-header::before {
        content: none;
    }
</style>
<section class="single-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="single-content">
                    <h2>Help Center</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Help Center</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="section-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card">

                </div>
                <div class="nav-pills">
                    <button class="" type="button" data-toggle="collapse" data-target="#all-content"
                        aria-expanded="false" aria-controls="all-content">
                        What Is Eversabz
                    </button>

                    <div class="collapse" id="all-content">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link " id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                                role="tab" aria-controls="v-pills-home" aria-selected="true"> What Is Eversabz</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile" aria-selected="false">How many Ads can I post on Eversabz?
                                </a>
                            <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages" aria-selected="false">Policies</a> -->
                        </div>
                    </div>

                    <button class="" type="button" data-toggle="collapse" data-target="#all-content1"
                        aria-expanded="false" aria-controls="all-content1">
                        Toggle All Sectionsssss
                    </button>

                    <div class="collapse" id="all-content1">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <a class="nav-link" id="v-pills-home-tab1" data-toggle="pill" href="#v-pills-home1" role="tab"
                                aria-controls="v-pills-home1" aria-selected="true">Basic</a>
                            <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                                role="tab" aria-controls="v-pills-profile1" aria-selected="false">Safety</a>
                            <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                                role="tab" aria-controls="v-pills-messages1" aria-selected="false">Policies</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Home Tab -->
                    <div class="card tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-home">
                            <h5>
                               What Is Eversabz?
                            </h5>
                        </div>
                        <div id="v-collapse-home" role="tabpanel" aria-labelledby="v-collapse-heading-home">
                            <div class="card-body">
                                <p>EverSabz is your ultimate online marketplace, offering a wide range of categories
                                    such as Electronics, Food & Dining, Entertainment, Sports, Automotive, Fashion &
                                    Clothing, Furniture, and more. We bring buyers and sellers together on a single,
                                    easy-to-navigate platform, making it simple to browse, discover, and engage with an
                                    extensive selection of products and services. Whether you're looking for the latest
                                    tech, planning a memorable dining experience, or upgrading your lifestyle, EverSabz
                                    has everything you need—all in one convenient location. Join our vibrant community
                                    and explore endless possibilities with EverSabz, your one-stop destination for
                                    buying and selling across diverse categories
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="card tab-pane fade" id="v-pills-profile" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-home">
                            <h5>
                            How many Ads can I post on Eversabz?

                            </h5>
                        </div>
                        <div class="card-body">
                            <p>
                                Community users on Eversabz can post an unlimited number of ads. However, businesses
                                or individuals operating in a commercial capacity may be required to list their ads
                                in the Services for Hire section.</p>

                            <p>We kindly request that users avoid posting duplicate ads. Every ad should be unique,
                                meaning it must differ significantly from others. Refrain from posting the same ad
                                multiple times across various categories or locations. Instead, ensure your ad is
                                listed in the location where you are physically based.</p>

                            <p>Rest assured, buyers conducting a broad search will still be able to find your ad,
                                regardless of its specific location.
                            </p>
                        </div>
                    </div>
                    <!-- Messages Tab -->
                    <div class="card tab-pane fade" id="v-pills-messages" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-messages">
                            <a data-toggle="collapse" href="#v-collapse-messages" aria-expanded="true"
                                aria-controls="v-collapse-messages">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages" class="collapse show" role="tabpanel"
                            aria-labelledby="v-collapse-heading-messages" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui
                                    magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure
                                    occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia
                                    dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam
                                    consectetur.</p>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-messages1">
                            <a data-toggle="collapse" href="#v-collapse-messages1" aria-expanded="false"
                                aria-controls="v-collapse-messages1">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages1" class="collapse" role="tabpanel"
                            aria-labelledby="v-collapse-heading-messages1" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui
                                    magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure
                                    occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia
                                    dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam
                                    consectetur.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="v-pills-tabContent">
                    <!-- Home Tab -->
                    <div class="card tab-pane fade" id="v-pills-home1" role="tabpanel"
                        aria-labelledby="v-pills-home-tab1">
                        <div class="card-header" role="tab" id="v-collapse-heading-home">
                            <h5>
                                How I create account?
                            </h5>
                        </div>
                        <div id="v-collapse-home" role="tabpanel" aria-labelledby="v-collapse-heading-home">
                            <div class="card-body">
                                <ol>
                                    <li>Simply click on the icon located at the top right of every Eversabz page</li>
                                    <li>Click on the sign-up button</li>
                                    <li>Fill up the form, select your account type, and submit</li>
                                    <li>If you have a business or organization account, submit the business or
                                        organization info after logging in and wait for admin approval</li>
                                </ol>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Tab -->
                    <div class="card tab-pane fade" id="v-pills-profile1" role="tabpanel"
                        aria-labelledby="v-pills-profile-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-profile">
                            <a data-toggle="collapse" href="#v-collapse-profile" aria-expanded="true"
                                aria-controls="v-collapse-profile">
                                Culpa dolor voluptate
                            </a>
                        </div>
                        <div id="v-collapse-profile" class="collapse show" role="tabpanel"
                            aria-labelledby="v-collapse-heading-profile" data-parent="#v-pills-profile">
                            <div class="card-body">
                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis
                                    pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor
                                    deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur
                                    adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu.
                                    Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint
                                    minim consectetur qui.</p>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-profile1">
                            <a data-toggle="collapse" href="#v-collapse-profile1" aria-expanded="false"
                                aria-controls="v-collapse-profile1">
                                Culpa dolor voluptate
                            </a>
                        </div>
                        <div id="v-collapse-profile1" class="collapse" role="tabpanel"
                            aria-labelledby="v-collapse-heading-profile1" data-parent="#v-pills-profile">
                            <div class="card-body">
                                <p>Culpa dolor voluptate do laboris laboris irure reprehenderit id incididunt duis
                                    pariatur mollit aute magna pariatur consectetur. Eu veniam duis non ut dolor
                                    deserunt commodo et minim in quis laboris ipsum velit id veniam. Quis ut consectetur
                                    adipisicing officia excepteur non sit. Ut et elit aliquip labore Lorem enim eu.
                                    Ullamco mollit occaecat dolore ipsum id officia mollit qui esse anim eiusmod do sint
                                    minim consectetur qui.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Messages Tab -->
                    <div class="card tab-pane fade" id="v-pills-messages1" role="tabpanel"
                        aria-labelledby="v-pills-messages-tab">
                        <div class="card-header" role="tab" id="v-collapse-heading-messages">
                            <a data-toggle="collapse" href="#v-collapse-messages" aria-expanded="true"
                                aria-controls="v-collapse-messages">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages" class="collapse show" role="tabpanel"
                            aria-labelledby="v-collapse-heading-messages" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui
                                    magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure
                                    occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia
                                    dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam
                                    consectetur.</p>
                            </div>
                        </div>

                        <div class="card-header" role="tab" id="v-collapse-heading-messages1">
                            <a data-toggle="collapse" href="#v-collapse-messages1" aria-expanded="false"
                                aria-controls="v-collapse-messages1">
                                Fugiat id quis dolor
                            </a>
                        </div>
                        <div id="v-collapse-messages1" class="collapse" role="tabpanel"
                            aria-labelledby="v-collapse-heading-messages1" data-parent="#v-pills-messages">
                            <div class="card-body">
                                <p>Fugiat id quis dolor culpa eiusmod anim velit excepteur proident dolor aute qui
                                    magna. Ad proident laboris ullamco esse anim Lorem Lorem veniam quis Lorem irure
                                    occaecat velit nostrud magna nulla. Velit et et proident Lorem do ea tempor officia
                                    dolor. Reprehenderit Lorem aliquip labore est magna commodo est ea veniam
                                    consectetur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection