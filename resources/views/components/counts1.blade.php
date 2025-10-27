<div class="dash-header-right-mobile">
    <div class="dash-focus dash-list">
        <h2>{{ $totalAdPosts > 0 ? $totalAdPosts : '0' }}</h2>
        <p>Total Ad Posts</p>
    </div>
    <div class="dash-focus dash-book">
        <h2>{{ $totalBusinessProducts > 0 ? $totalBusinessProducts : '0' }}</h2>
        <p>Total Business Products</p>
    </div>
    <div class="dash-focus dash-rev">
        <h2>{{ $totalEvents > 0 ? $totalEvents : '0' }}</h2>
        <p>Total Events</p>
    </div>
</div>

<style>
@media (max-width: 992px) {
    .dash-header-right-mobile {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-left: 6px;
    }

    .dash-header-right-mobile .dash-focus {
        flex: 1; /* each box takes equal width */
        padding: 5px 0;
        text-align: center;
        font-size: 0.9rem;
    }

    .dash-header-right-mobile .dash-focus h2 {
        font-size: 18px;
        margin-bottom: 2px;
    }

    .dash-header-right-mobile .dash-focus p {
        font-size: 14px;
        margin: 0;
    }
    .dash-focus::before {
        width: 109px;
    }
    .dash-focus:last-child {
        margin-bottom: 20px;
    }
}


</style>