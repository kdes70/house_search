<template>
  <div>
    <h2>Filters</h2>
    <el-row class="filter_row" :gutter="20">
      <el-col :span="10">
        <span class="input-label">Name</span>
        <el-input v-model.trim="formData.name" placeholder="Name search"></el-input>
      </el-col>
      <el-col :span="10">
        <span class="input-label">Price</span>
        <div class="block">
          <el-slider
              v-model="formData.price"
              range
              show-stops
              :step="getAvailableFilters.maxPrice / 10000 || 100"
              :min="getAvailableFilters.minPrice || 0"
              :max="getAvailableFilters.maxPrice || 0">
          </el-slider>
        </div>
      </el-col>
    </el-row>
    <el-row class="filter_row" :gutter="20">
      <el-col :span="6">
        <span class="input-label">Bathrooms</span>
        <el-select v-model="formData.bathrooms" clearable placeholder="Select">
          <el-option
              v-for="item in getAvailableFilters.bathrooms"
              :key="item"
              :label="item"
              :value="item">
          </el-option>
        </el-select>
      </el-col>
      <el-col :span="6">
        <span class="input-label">Bedrooms</span>
        <el-select v-model="formData.bedrooms" clearable placeholder="Select">
          <el-option
              v-for="item in getAvailableFilters.bedrooms"
              :key="item"
              :label="item"
              :value="item">
          </el-option>
        </el-select>
      </el-col>
      <el-col :span="6">
        <span class="input-label">Garages</span>
        <el-select v-model="formData.garages" clearable placeholder="Select">
          <el-option
              v-for="item in getAvailableFilters.garages"
              :key="item"
              :label="item"
              :value="item">
          </el-option>
        </el-select>
      </el-col>
      <el-col :span="6">
        <span class="input-label">Storeys</span>
        <el-select v-model="formData.storeys" clearable placeholder="Select">
          <el-option
              v-for="item in getAvailableFilters.storeys"
              :key="item"
              :label="item"
              :value="item">
          </el-option>
        </el-select>
      </el-col>

    </el-row>
    <el-button type="primary" @click="handleFilter">Filters</el-button>
    <el-button @click="handleClear">Clear</el-button>
    <el-divider></el-divider>
    <div class="filter_row"></div>
  </div>
</template>

<script>

import {mapGetters} from "vuex";

export default {
  name: "Filters",
  data() {
    return {
      formData: this.$store.getters.getFilters,
    }
  },
  computed: {
    ...mapGetters(['getAvailableFilters']),
  },
  methods: {
    handleFilter() {
      this.$store.dispatch('addFilters', this.formData)

    },
    handleClear() {
      this.$store.dispatch('clearFilters')
    }
  }
}
</script>
<style>
.filter_row {
  margin-bottom: 20px;
}
</style>
