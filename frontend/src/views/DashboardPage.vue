<template>
  <div>
    <CCard accent-color="primary">
      <CCardHeader>
        Card title
        <div class="card-header-actions">
          <a 
            href="https://coreui.io/vue/docs/components/card-components" 
            class="card-header-action" 
            rel="noreferrer noopener" 
            target="_blank"
          >
            <small class="text-muted">docs</small>
          </a>
        </div>
      </CCardHeader>
      <CCardBody>
        <p>Dashboard</p>
        <p>{{ $route.path }}</p>
      </CCardBody>
    </CCard>
  </div>
</template>

<script>
export default {
  name: 'DashboardPage'
}
</script>

<style>

</style>