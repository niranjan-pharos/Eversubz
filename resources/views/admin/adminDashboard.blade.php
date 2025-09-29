@extends('admin.template.master')

@section('content')
<style>
    .dashboard-container {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .dashboard-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    /* Card Header */
    .dashboard-card h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Card Numbers */
    .dashboard-card .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #111;
        margin-bottom: 10px;
    }

    /* Sub Stats */
    .dashboard-card .sub-stats {
        font-size: 14px;
        color: #666;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* Add Icon Circle */
    .icon-badge {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }

    /* Different Card Colors */
    .users   { background: linear-gradient(135deg, #e3f2fd, #ffffff); }
    .ads     { background: linear-gradient(135deg, #fdecea, #ffffff); }
    .business{ background: linear-gradient(135deg, #e8f5e9, #ffffff); }
    .products{ background: linear-gradient(135deg, #fff8e1, #ffffff); }
    .events  { background: linear-gradient(135deg, #f1f3f4, #ffffff); }
    .ngos    { background: linear-gradient(135deg, #e0f7fa, #ffffff); }
    .jobs    { background: linear-gradient(135deg, #ede7f6, #ffffff); }

    /* Icon Colors */
    .users .icon-badge   { background: #007bff; }
    .ads .icon-badge     { background: #dc3545; }
    .business .icon-badge{ background: #28a745; }
    .products .icon-badge{ background: #ffc107; color: #000; }
    .events .icon-badge  { background: #6c757d; }
    .ngos .icon-badge    { background: #17a2b8; }
    .jobs .icon-badge    { background: #673ab7; }
</style>

<h3>Welcome to Dashboard, Ali!</h3>

<div class="dashboard-container">
    <!-- Users -->
    <div class="dashboard-card users">
        <h3><span>Total Users</span> <span class="icon-badge">👤</span></h3>
        <div class="stat-number">{{ $totalUsersCount }}</div>
    </div>

    <!-- Ads -->
    <div class="dashboard-card ads">
        <h3><span>Total Ads</span> <span class="icon-badge">📢</span></h3>
        <div class="stat-number">{{ $adstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $adsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $adsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <!-- Businesses -->
    <div class="dashboard-card business">
        <h3><span>Total Businesses</span> <span class="icon-badge">🏢</span></h3>
        <div class="stat-number">{{ $businesstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $businessactiveAdPostsCount }}</span>
            <span>Inactive: {{ $businessinactiveAdPostsCount }}</span>
        </div>
    </div>

    <!-- Products -->
    <div class="dashboard-card products">
        <h3><span>Total Products</span> <span class="icon-badge">📦</span></h3>
        <div class="stat-number">{{ $productstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $productsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $productsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <!-- Events -->
    <div class="dashboard-card events">
        <h3><span>Total Events</span> <span class="icon-badge">🎉</span></h3>
        <div class="stat-number">{{ $eventstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $eventsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $eventsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <!-- NGOs -->
    <div class="dashboard-card ngos">
        <h3><span>Total NGOs</span> <span class="icon-badge">🤝</span></h3>
        <div class="stat-number">{{ $ngostotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $ngosactiveAdPostsCount }}</span>
            <span>Inactive: {{ $ngosinactiveAdPostsCount }}</span>
        </div>
    </div>

    <!-- Jobs -->
    <div class="dashboard-card jobs">
        <h3><span>Total Jobs</span> <span class="icon-badge">💼</span></h3>
        <div class="stat-number">{{ $jobstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $jobsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $jobsinactiveAdPostsCount }}</span>
        </div>
    </div>
</div>

@endsection


<!-- 

<style>
    .dashboard-container {
        margin-top: 40px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .dashboard-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
    }

    /* Card Header */
    .dashboard-card h3 {
        font-size: 18px;
        font-weight: 600;
        margin: 0 0 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Card Numbers */
    .dashboard-card .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #111;
        margin-bottom: 10px;
    }

    /* Sub Stats */
    .dashboard-card .sub-stats {
        font-size: 14px;
        color: #666;
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    /* Add Icon Circle */
    .icon-badge {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: bold;
        color: #fff;
    }

    /* Different Card Colors */
    .users   { background: linear-gradient(135deg, #e3f2fd, #ffffff); }
    .ads     { background: linear-gradient(135deg, #fdecea, #ffffff); }
    .business{ background: linear-gradient(135deg, #e8f5e9, #ffffff); }
    .products{ background: linear-gradient(135deg, #fff8e1, #ffffff); }
    .events  { background: linear-gradient(135deg, #f1f3f4, #ffffff); }
    .ngos    { background: linear-gradient(135deg, #e0f7fa, #ffffff); }
    .jobs    { background: linear-gradient(135deg, #ede7f6, #ffffff); }

    /* Icon Colors */
    .users .icon-badge   { background: #007bff; }
    .ads .icon-badge     { background: #dc3545; }
    .business .icon-badge{ background: #28a745; }
    .products .icon-badge{ background: #ffc107; color: #000; }
    .events .icon-badge  { background: #6c757d; }
    .ngos .icon-badge    { background: #17a2b8; }
    .jobs .icon-badge    { background: #673ab7; }
</style>

<h3>Welcome to Dashboard, Ali!</h3>

<div class="dashboard-container">
    <div class="dashboard-card users">
        <h3><span>Total Users</span> <span class="icon-badge">👤</span></h3>
        <div class="stat-number">{{ $totalUsersCount }}</div>
    </div>

    <div class="dashboard-card ads">
        <h3><span>Total Ads</span> <span class="icon-badge">📢</span></h3>
        <div class="stat-number">{{ $adstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $adsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $adsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <div class="dashboard-card business">
        <h3><span>Total Businesses</span> <span class="icon-badge">🏢</span></h3>
        <div class="stat-number">{{ $businesstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $businessactiveAdPostsCount }}</span>
            <span>Inactive: {{ $businessinactiveAdPostsCount }}</span>
        </div>
    </div>

    <div class="dashboard-card products">
        <h3><span>Total Products</span> <span class="icon-badge">📦</span></h3>
        <div class="stat-number">{{ $productstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $productsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $productsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <div class="dashboard-card events">
        <h3><span>Total Events</span> <span class="icon-badge">🎉</span></h3>
        <div class="stat-number">{{ $eventstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $eventsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $eventsinactiveAdPostsCount }}</span>
        </div>
    </div>

    <div class="dashboard-card ngos">
        <h3><span>Total NGOs</span> <span class="icon-badge">🤝</span></h3>
        <div class="stat-number">{{ $ngostotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $ngosactiveAdPostsCount }}</span>
            <span>Inactive: {{ $ngosinactiveAdPostsCount }}</span>
        </div>
    </div>

    <div class="dashboard-card jobs">
        <h3><span>Total Jobs</span> <span class="icon-badge">💼</span></h3>
        <div class="stat-number">{{ $jobstotalCount }}</div>
        <div class="sub-stats">
            <span>Active: {{ $jobsactiveAdPostsCount }}</span>
            <span>Inactive: {{ $jobsinactiveAdPostsCount }}</span>
        </div>
    </div>
</div>

 -->
