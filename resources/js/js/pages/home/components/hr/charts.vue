<template>
    <div className="card card-xxl-stretch mb-5">
        <div class="card-body pt-5 ">
            <!--div class="row">
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >العمليات خلال العام الجديد</div>
                    <apexchart  type="bar" :options="options" :series="series"></apexchart>
                </div>
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >الموازنة حسب الشهر($K)</div>
                    <apexchart  type="bar"  :options="options2" :series="series2"></apexchart>
                </div>
            </div-->
            <div class="row">
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >طلبات الأقسام</div>
                    <apexchart ref="departmentRequests"  type="donut" :options="chartOptions3" :series="series3"></apexchart>
                </div>
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >الموظفون</div>
                    <apexchart  ref="employeeChart" type="donut"  :options="options4" :series="series4"></apexchart>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";
import shared from "../../../../src/shared";

export default {
    name: "charts",
    components:{VueApexCharts},
    data: function() {
        return {
            results: [],
            api_search: "/api/hr/hr",
            options: {

                xaxis: {
                    categories: ["مهام", "اتصالات", "e", "w", "q", "مراسلات"]
                },
                theme: {
                    palette: 'palette2'
                },
                fill: {
                    colors: ['#fc4b0a', '#E91E63', '#9C27B0']
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60]
            }],

            series2: [
                {
                name: 'المصروفات',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'الايرادات',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'المتبقي',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            options2:{

                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمر'],
                },
               /* yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },*/
                fill: {
                    opacity: 1
                },

            },
            series3: [44, 25, 99],
            chartOptions3: {
                labels: ['جديد', ' مرفوض', 'تم']
            },

            options4: {
                    labels: ["السكرتاريا", "الشئون الادارية", "المالية", "q", "w", "الاعلام"]
            },
            series4:  [30, 40, 45, 50, 49, 60],
        }
    },
    created() {
        this.search();
    },
    mounted() {
        this.$watch(
            () => [this.series, this.options],
            () => {
                this.updateChart();
            },
            { deep: true }
        );
    },
    methods: {
        async search() {
            this.results = (await shared.post(this.api_search)).data;
            this.options.xaxis.categories = this.results.months;
            this.series[0].data = this.results.values;

            this.chartOptions3.labels = this.results.stats_3;
            this.series3 = this.results.values_3;

            this.options4.labels = this.results.stats_2;
            this.series4 = this.results.values_2;
        },
        updateChart() {
            //this.$refs.chart.updateOptions(this.options);
            //this.$refs.chart.updateSeries(this.series);
            this.$refs.departmentRequests.updateOptions(this.chartOptions3);
            this.$refs.departmentRequests.updateSeries(this.series3);

            this.$refs.employeeChart.updateOptions(this.options4);
            this.$refs.employeeChart.updateSeries(this.series4);
        },
    },
}
</script>


