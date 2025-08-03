<template>
    <div className="card card-xxl-stretch mb-5">
        <div class="card-body pt-5 ">
            <div class="row">
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >العمليات خلال العام الجديد</div>
                    <apexchart  type="bar" :options="options" :series="series"></apexchart>
                </div>
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >الموازنة حسب الشهر($K)</div>
                    <apexchart  type="bar"  :options="options2" :series="series2"></apexchart>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 border-2 border-gray-300 border-dashed">
                    <div class="text-center" >طلبات الأقسام</div>
                    <apexchart  type="donut" :options="chartOptions3" :series="series3"></apexchart>
                </div>

            </div>

        </div>
    </div>
</template>

<script>
import VueApexCharts from "vue3-apexcharts";

export default {
    name: "charts",
    components:{VueApexCharts},
    data: function() {
        return {
            options: {

                xaxis: {
                    categories: ["مهام", "اتصالات", "مواعيد", "اجتماعات", "لجان", "مراسلات"]
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


        }
    }
}
</script>


