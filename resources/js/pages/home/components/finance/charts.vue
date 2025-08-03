<template>
    <div className="card card-xxl-stretch mb-5">
        <div class="card-body pt-5 ">
            <div class="row">
                <div class="text-center" >الموازنة السنوية</div>
                <apexchart  type="line"  :options="chartOptions2" :series="series2"></apexchart>
            </div>
            <div class="row">
                <div class="col-xl-5">
                    <div class="text-center" >طلبات الأقسام</div>
                    <apexchart  type="donut" :options="chartOptions3" :series="series3"></apexchart>
                </div>
                <div class="col-xl-7">
                    <div class="text-center" > موازنات الأقسام</div>
                    <apexchart  type="bar"  :options="options4" :series="series4"></apexchart>
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
                    categories: ["مهام", "اتصالات", "d", "f", "s", "مراسلات"]
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

            series2: [{
                name: 'الدخل',
                type: 'column',
                data: [1.4, 2, 2.5, 1.5, 2.5,  4.6]
            }, {
                name: 'المصروفات',
                type: 'column',
                data: [1.1, 3, 3.1, 4, 4.1,, 8.5]
            }, {
                name: 'المتبقي',
                type: 'line',
                data: [20, 29, 37, 36,  50, 58]
            }],
            chartOptions2: {
                chart: {
                    height: 350,
                    type: 'line',
                    stacked: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [1, 1, 4]
                },

                xaxis: {
                    categories: [2018, 2019, 2020, 2021, 2022, 2023],
                },
                yaxis: [
                    {
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#008FFB'
                        },
                        labels: {
                            style: {
                                colors: '#008FFB',
                            }
                        },
                        title: {
                            text: "Income (thousand crores)",
                            style: {
                                color: '#008FFB',
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    {
                        seriesName: 'الدخل',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#00E396'
                        },
                        labels: {
                            style: {
                                colors: '#00E396',
                            }
                        },
                        title: {
                            text: "المصروفات",
                            style: {
                                color: '#00E396',
                            }
                        },
                    },
                    {
                        seriesName: 'الميزانية',
                        opposite: true,
                        axisTicks: {
                            show: true,
                        },
                        axisBorder: {
                            show: true,
                            color: '#FEB019'
                        },
                        labels: {
                            style: {
                                colors: '#FEB019',
                            },
                        },
                        title: {
                            text: "الميزانية",
                            style: {
                                color: '#FEB019',
                            }
                        }
                    },
                ],
                tooltip: {
                    fixed: {
                        enabled: true,
                        position: 'topRight', // topRight, topLeft, bottomRight, bottomLeft
                        offsetY: 30,
                        offsetX: 60
                    },
                },
                legend: {
                    horizontalAlign: 'right',
                    offsetX: 40
                }
            },
            series3: [44, 25, 99],
            chartOptions3: {
                labels: ['جديد', ' مرفوض', 'تم']
            },

            options4: {

                xaxis: {
                    categories: ["السكرتاريا", "الشئون الادارية", "e", "w", "q", "الاعلام"]
                },
                theme: {
                    palette: 'palette2'
                },

            },
            series4: [
                {
                    name: 'الايرادات',
                    data: [30, 40, 45, 50, 55, 60]
                },
                {
                    name: 'المصروفات',
                    data: [25, 30, 40, 30, 49, 55]
                },
                {
                    name: 'المتبقي',
                    data: [5, 10, 5, 20, 6, 5]
                }
                ],
        }
    }
}
</script>


