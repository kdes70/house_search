<template>
  <el-container id="app">
    <el-main>
      <el-card class="box-card">
          <Filters></Filters>
          <Table></Table>
      </el-card>
    </el-main>
  </el-container>
</template>

<script>

import Filters from '@/components/Filters'
import Table from '@/components/Table'

export default {
  name: 'app',
  components: {
    Filters,
    Table
  },
}
</script>

<style scoped>
.el-card {
  width: 1024px;
  margin: 0 auto;
  transition: all .5s;
}
</style>
