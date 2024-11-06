<template>
  <main class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">

    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Products</p>
                        <h4 class="my-1">3</h4>
                        <p class="mb-0 font-13 text-success">
                            <i class="bi bi-caret-up-fill"></i> 4 from last week
                        </p>
                    </div>
                    <div class="widget-icon-large bg-gradient-purple text-white ms-auto">
                          <i class="bi bi-basket2-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Customers</p>
                        <h4 class="my-1">6</h4>
                        <p class="mb-0 font-13 text-success">
                            <i class="bi bi-caret-up-fill"></i> 8 from last week
                        </p>
                    </div>
                    <div class="widget-icon-large bg-gradient-success text-white ms-auto">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Orders</p>
                        <h4 class="my-1">1</h4>
                        <p class="mb-0 font-13 text-danger">
                            <i class="bi bi-caret-down-fill"></i> 9 from last week
                        </p>
                    </div>
                    <div class="widget-icon-large bg-gradient-danger text-white ms-auto">
                         <i class="bi bi-cart-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <p class="mb-0 text-secondary">Total Sales</p>
                        <h4 class="my-1">5</h4>
                        <p class="mb-0 font-13 text-success">
                            <i class="bi bi-caret-up-fill"></i> 1 from last week
                        </p>
                    </div>
                    <div class="widget-icon-large bg-gradient-info text-white ms-auto">
                        <i class="bi bi-bar-chart-line-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>
</template>

<script>
export default {
  name: 'Dashboard'
}
</script>

<style scoped>
/* Add any additional styles here */
</style>
