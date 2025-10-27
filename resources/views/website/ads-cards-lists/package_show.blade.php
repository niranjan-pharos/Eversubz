@extends('frontend.template.master')


@section('title', 'Explore Exciting Advertise | Eversabz Advertise Listings')
@section('description', 'Explore diverse job opportunities with Eversabz. Find your perfect career match and apply
    today. Start your journey towards a fulfilling professional future!')

@section('content')
<style>
    :root {
        --theme-color: #2773ba;
        --theme-hover: #1e5c8f;
        --bg-light: #f8fbff;
        --card-bg: #ffffff;
    }

    body {
        background-color: var(--bg-light);
    }

    .card-custom {
        background-color: var(--card-bg);
        border: 1px solid #007bff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .card-custom:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .img-card {
        border-radius: 10px;
        transition: transform 0.3s;
    }
    .img-card:hover {
        transform: scale(1.05);
    }

    .btn-main {
        font-size: 16px;
        padding: 15px 0;
        border-radius: 5px;
        transition: all 0.3s;
        background-color: var(--theme-color);
        border: none;
        color: #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-main:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px #fff;
        background-color: var(--theme-hover);
    }

    .btn-counter {
        width: 40px;
        height: 40px;
        font-size: 1.2rem;
        border-radius: 8px;
        border: 2px solid var(--theme-color);
        background-color: transparent;
        color: var(--theme-color);
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        transition: all 0.2s;
        box-shadow: 0 3px 8px rgba(0,0,0,0.08);
    }
    .btn-counter:hover {
        background-color: var(--theme-color);
        color: #fff;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }

    #counter {
        font-size: 26px;
        min-width: 80px;
        text-align: center;
        color: var(--theme-color);
        font-weight: 600;
    }

    .omid-switch button {
        flex: 1;
        padding: 5px 0;
        border-radius: 12px;
        font-size: 1rem;
        border: 1px solid #ccc;
        transition: all 0.3s;
        background-color: #f0f5fa;
        color: #333;
        cursor: pointer;
        box-shadow: 0 3px 8px rgba(0,0,0,0.05);
    }
    .omid-switch button.active {
        background-color: var(--theme-color);
        color: #fff;
        border-color: var(--theme-color);
        box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    }
    .omid-switch button:not(.active):hover {
        background-color: #e0efff;
    }

    .omid-container {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-top: 15px;
    }

    .faq-section {
        max-width: 1300px;
        margin: 20px -30px;
        padding: 0 20px;
        font-family: "Inter", sans-serif;
    }

    .faq-item {
        background: #f9f9f9;
        border: 1px solid #e3e3e3;
        border-radius: 12px;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .faq-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        padding: 18px 20px;
        font-size: 1.05rem;
        font-weight: 600;
        color: #222;
        background: #fff;
        transition: background 0.3s ease;
    }

    .faq-header:hover {
        background: #2773ba;
        color: #fff;
    }

    .faq-item.active .faq-header {
        background: #2773ba;
        color: #fff;
    }

    .faq-item.active .faq-icon{
        color: #fff;
    }

    .faq-icon {
        transition: transform 0.3s ease;
        font-size: 20px;
        color: #00a884;
    }

    .faq-body {
        max-height: 0;
        overflow: hidden;
        background: #fafafa;
        color: #555;
        font-size: 0.95rem;
        line-height: 1.6;
        padding: 0 20px;
        transition: all 0.35s ease;
    }

    .faq-item.active .faq-body {
        max-height: 500px;
        padding: 18px 20px;
    }

    .faq-item.active .faq-icon {
        transform: rotate(180deg);
    }

    #aseelCounterSection{
        margin-top: 50px;
    }

    @media (max-width: 768px) {
        .faq-header {
            font-size: 1rem;
        }

        .faq-section{
            margin: 20px 0;
        }
        h1 {
            font-size: 32px;
        }
        .faq-body {
            font-size: 0.9rem;
        }
    }

    .input-group-text i {
        font-size: 1.2rem;
    }

    .btn-outline-secondary.active {
        background-color: #2773ba; /* your theme color */
        color: #fff;
        border-color: #2773ba;
    }

    #userSearchResults li {
        cursor: pointer;
        padding: 10px;
        transition: background 0.2s;
    }
    #userSearchResults li:hover {
        background-color: #e6f2fb; /* light theme hover */
    }

.card-body .avatar {
    font-weight: bold;
    text-transform: uppercase;
    background-color: #2773ba;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.faq-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.faq-list li {
    padding: 10px 0;
    border-bottom: 1px dashed #b8cde5;
    font-size: 15px;
    color: #333;
}

.faq-list li:last-child {
    border-bottom: none;
}


</style>

<div class="container py-5">
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card card-custom">
                <img src="{{ $package['image'] }}" alt="{{ $package['title'] }}" class="img-fluid img-card">
            </div>

            <div class="faq-section">
                <div class="faq-item">
                    <div class="faq-header">
                        <span>What is in the package?</span>
                        <span class="faq-icon">⌄</span>
                    </div>
                    <div class="faq-body">
                        <ul class="faq-list">
                            <li>Winter Jacket <span style="float: right;">1</span></li>
                            <li>Shoe <span style="float: right;">1</span></li>
                            <li>Socks <span style="float: right;">2</span></li>
                            <li>Sweat Pants and Under Shirts <span style="float: right;">1</span></li>
                            <li>Hat <span style="float: right;">1</span></li>
                        </ul>
                    </div>
                </div>
            </div>



        </div>

        <div class="col-md-6">
            <div class="card card-custom p-4 d-flex flex-column justify-content-between">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-3">{{ $package['title'] }}</h1>
                    <p class="h4 text-success fw-semibold mb-4">${{ number_format($package['price'], 2) }}</p>

                    <p class="text-secondary mb-4">{{ $package['description'] }}</p>

                    <h3 class="h6 fw-semibold mb-3">Who are you trying to help?</h3>
                    <div class="mb-4 d-flex gap-3" style="gap: 20px;">
                        <button id="letAseel" class="btn btn-outline-secondary">Let Aseel Decide</button>
                        <button id="someoneIKnow" class="btn btn-outline-secondary">Someone I know</button>
                    </div>

                    <div id="aseelCounterSection" class="d-none mb-4">
                        <div class="d-flex align-items-center gap-2 mb-3 ml-2">
                            <button id="decrease" class="btn btn-counter">-</button>
                            <span id="counter">0</span>
                            <button id="increase" class="btn btn-counter">+</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-main px-4">Next</button>
                        </div>
                    </div>

                    <div id="omidIdSection" class="d-none mt-3">
                        <div class="omid-container mb-3">
                            <span class="fw-medium">Does the person have a User ID?</span>
                            <div class="omid-switch d-flex gap-2 flex-grow-1">
                                <button id="omidYes" class="active">Yes</button>
                                <button id="omidNo">No</button>
                            </div>
                        </div>

                        <!-- Search Field (hidden by default) -->
                        <div id="userSearchField" class="mt-3">
                            <div class="position-relative">
                                <input type="text" id="userSearchInput" class="form-control border border-secondary" placeholder="Search User ID" style="padding-right: 40px; border-radius: 10px;">
                                <i class="fa fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); color: #2773ba; font-size: 1.2rem;"></i>
                            </div>

                            <ul id="userSearchResults" class="list-group position-absolute w-100" style="z-index: 1000; display: none; max-height: 200px; overflow-y: auto;"></ul>

                            <div id="selectedUser" class="mt-3"></div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <h1 class="text-center mt-5">Q&A</h1>

        <div class="faq-section">
            <div class="faq-item">
                <div class="faq-header">
                    <span>What is Aseel's DirectAid Beta?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Aseel's DirectAid Beta builds on Aseel's decentralized aid platform, which has served over 500,000 individuals since August 2021. It introduces Omid ID Cards for accurate beneficiary identification, the Atalan Network for on-the-ground support, and transparency via video documentation and emails. The process involves Send Aid, Track Aid, and receiving a distribution video for donors to witness the impact of their contribution.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How long does an aid delivery take?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    It typically takes 24 to 48 working hours for the Atalan team to deliver an emergency package to the designated Omid ID holder across Afghanistan. However, the delivery can take longer sometimes due to unpredictable circumstances that are out of Aseel and Atalan's control.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How much does Aseel charge per delivery?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Aseel charges a flat fee of 10% of the package's price for each delivery.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>How much is an Atal paid for a delivery?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    Atalan payment depends on the type of Emergency Package delivery. For the delivery of a Small Emergency Food Package, an Atal is paid $3 to $5 for an Emergency Food Package or Emergency Child Relief Package, and $7 for the delivery of a Large Family Package.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-header">
                    <span>What are the available DirectAid packages?</span>
                    <span class="faq-icon">⌄</span>
                </div>
                <div class="faq-body">
                    There are multiple emergency packages available that can be donated under the DirectAid Beta. The packages include a Large Family Food Package, an Emergency Small Food Package, an Emergency Package for Child, Emergency Food Package, an Emergency Baby Care Package, and Donate and Let Aseel Decide. Other packages will be added to the DirectAid packages based on the need. For instance, the Emergency Winter Package will be added in winter.
                </div>
            </div>
        </div>
</div>

<script>
$(document).ready(function() {

    $('#userSearchInput').on('input', function() {
        let query = $(this).val().trim();
        if(query.length > 0) {
            $.ajax({
                url: "{{route('searchuserid')}}",
                method: 'GET',
                data: { q: query },
                success: function(response) {
                    let results = $('#userSearchResults');
                    results.empty();
                    if(response.length > 0) {
                        response.forEach(function(user) {
                            results.append('<li class="list-group-item" data-name="' + user.name + '" data-uid="' + user.uid + '" data-email="' + (user.email || '') + '">' + user.name + ' (' + user.uid + ')</li>');
                        });
                        results.show();
                    } else {
                        results.hide();
                    }
                },
                error: function() {
                    $('#userSearchResults').hide();
                }
            });
        } else {
            $('#userSearchResults').hide();
        }
    });

    $(document).on('click', '#userSearchResults li', function() {
        let name = $(this).data('name');
        let uid = $(this).data('uid');
        let email = $(this).data('email');

        let html = `
            <div class="card shadow-sm border-0" style="border-radius: 12px;">
                <div class="card-body d-flex align-items-center gap-3" style="gap:20px">
                    <div class="avatar bg-primary text-white rounded-circle d-flex justify-content-center align-items-center" style="width:60px; height:60px; font-size:1.5rem;">
                        ${name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <h5 class="card-title mb-1">${name}</h5>
                        <p class="card-text mb-0">UID: <span class="fw-semibold">${uid}</span></p>
                        ${email ? `<p class="card-text mb-0">Email: ${email}</p>` : ''}
                    </div>
                </div>
            </div>
        `;

        $('#selectedUser').html(html);
        $('#userSearchResults').hide();
        $('#userSearchInput').val('');
    });

    $(document).click(function(e) {
        if(!$(e.target).closest('#userSearchField').length) {
            $('#userSearchResults').hide();
        }
    });
});


const letAseelBtn = document.getElementById('letAseel');
const someoneBtn = document.getElementById('someoneIKnow');
const aseelCounterSection = document.getElementById('aseelCounterSection');
const omidIdSection = document.getElementById('omidIdSection');
const counterDisplay = document.getElementById('counter');
const decreaseBtn = document.getElementById('decrease');
const increaseBtn = document.getElementById('increase');
const omidYes = document.getElementById('omidYes');
const omidNo = document.getElementById('omidNo');
const userSearchField = document.getElementById('userSearchField');
let count = 0;

letAseelBtn.addEventListener('click', function () {
    letAseelBtn.classList.add('active');
    someoneBtn.classList.remove('active');
    aseelCounterSection.classList.remove('d-none');
    omidIdSection.classList.add('d-none');
});

someoneBtn.addEventListener('click', function () {
    someoneBtn.classList.add('active');
    letAseelBtn.classList.remove('active');
    omidIdSection.classList.remove('d-none');
    aseelCounterSection.classList.add('d-none');
});

increaseBtn.addEventListener('click', function () {
    count++;
    counterDisplay.textContent = count;
});

decreaseBtn.addEventListener('click', function () {
    if(count > 0) count--;
    counterDisplay.textContent = count;
});

omidYes.addEventListener('click', function() {
    omidYes.classList.add('active');
    omidNo.classList.remove('active');
    userSearchField.classList.remove('d-none');
});

omidNo.addEventListener('click', function() {
    omidNo.classList.add('active');
    omidYes.classList.remove('active');
    userSearchField.classList.add('d-none');
});

document.querySelectorAll('.faq-header').forEach(header => {
    header.addEventListener('click', () => {
        const item = header.parentElement;
        item.classList.toggle('active');
    });
});
</script>

@endsection