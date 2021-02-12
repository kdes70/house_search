<template>
  <div>
    <el-table
        :data="getHouses"
        v-loading="loading"
        height="250"
        style="width: 100%">
      <el-table-column v-for="(column, index) in getTableColumn"
                       :key="index"
                       :label="column"
                       :prop="column.toLocaleLowerCase()">
      </el-table-column>
    </el-table>
    <div style="text-align: center; margin-top: 20px">
      <el-pagination
          background
          layout="prev, pager, next"
          @current-change="handleCurrentChange"
          :page-size="getHousesMeta.per_page"
          :total="getHousesMeta.total">
      </el-pagination>
    </div>
  </div>

</template>

<script>

import {mapGetters} from "vuex";

export default {
  name: "Table",
  computed: {
    ...mapGetters(['loading', 'getTableColumn', 'getHouses', 'getHousesMeta']),
  },
  mounted() {
    this.$store.dispatch('fetchHouses')
  },
  methods: {
    handleCurrentChange(current_page) {

      let page = current_page ? current_page : 1

      this.$store.dispatch('getPage', page)
    },
  },
}
</script>

<style scoped>

</style>