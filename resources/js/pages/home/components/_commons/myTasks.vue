<template>
    <div className="card card-xl-stretch mb-5 mb-xl-8">
        <!--begin::Header-->
        <div className="card-header border-0 pt-5">
            <h3 className="card-title align-items-start flex-column">
                <span className="card-label fw-bolder fs-3 mb-1">المهام</span>
            </h3>

        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div className="card-body py-3">
            <!--begin::Table container-->
            <div className="table-responsive">
                <!--begin::Table-->
                <table className="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                    <tr className="fw-bolder text-muted">
                        <th className="min-w-150px">العنوان</th>
                        <th className="min-w-140px">التاريخ</th>
                        <th className="min-w-120px">درجة الانجاز</th>
                        <th className="min-w-100px text-end">....</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                    <tr>

                        <td>
                            <div className="d-flex align-items-center">

                                <div className="d-flex justify-content-start flex-column">
                                    <a href="#" className="text-dark fw-bolder text-hover-primary fs-6">Ana
                                        Simmons</a>
                                    <span className="text-muted fw-bold text-muted d-block fs-7">HTML, JS, ReactJS</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" className="text-dark fw-bolder text-hover-primary d-block fs-6">Intertico</a>
                            <span
                                className="text-muted fw-bold text-muted d-block fs-7">Web, UI/UX Design</span>
                        </td>
                        <td className="text-end">
                            <div className="d-flex flex-column w-100 me-2">
                                <div className="d-flex flex-stack mb-2">
                                    <span className="text-muted me-2 fs-7 fw-bold">50%</span>
                                </div>
                                <div className="progress h-6px w-100">
                                    <div className="progress-bar bg-primary" role="progressbar"
                                         style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div className="d-flex justify-content-end flex-shrink-0">

                                <router-link :to="{name: 'taskDetails', params: { id: 123 }}" className="badge badge-light-success fs-8 fw-bolder me-1">
                                    التفاصيل
                                </router-link>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div className="d-flex align-items-center">

                                <div className="d-flex justify-content-start flex-column">
                                    <a href="#" className="text-dark fw-bolder text-hover-primary fs-6">Jessie
                                        Clarcson</a>
                                    <span className="text-muted fw-bold text-muted d-block fs-7">C#, ASP.NET, MS SQL</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#"
                               className="text-dark fw-bolder text-hover-primary d-block fs-6">Agoda</a>
                            <span
                                className="text-muted fw-bold text-muted d-block fs-7">Houses &amp; Hotels</span>
                        </td>
                        <td className="text-end">
                            <div className="d-flex flex-column w-100 me-2">
                                <div className="d-flex flex-stack mb-2">
                                    <span className="text-muted me-2 fs-7 fw-bold">70%</span>
                                </div>
                                <div className="progress h-6px w-100">
                                    <div className="progress-bar bg-danger" role="progressbar"
                                         style="width: 70%" aria-valuenow="70" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div className="d-flex justify-content-end flex-shrink-0">

                                <router-link :to="{name: 'taskDetails', params: { id: 123 }}" className="badge badge-light-success fs-8 fw-bolder me-1">
                                    التفاصيل
                                </router-link>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div className="d-flex align-items-center">

                                <div className="d-flex justify-content-start flex-column">
                                    <a href="#" className="text-dark fw-bolder text-hover-primary fs-6">Lebron
                                        Wayde</a>
                                    <span className="text-muted fw-bold text-muted d-block fs-7">PHP, Laravel, VueJS</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#"
                               className="text-dark fw-bolder text-hover-primary d-block fs-6">RoadGee</a>
                            <span className="text-muted fw-bold text-muted d-block fs-7">Transportation</span>
                        </td>
                        <td className="text-end">
                            <div className="d-flex flex-column w-100 me-2">
                                <div className="d-flex flex-stack mb-2">
                                    <span className="text-muted me-2 fs-7 fw-bold">60%</span>
                                </div>
                                <div className="progress h-6px w-100">
                                    <div className="progress-bar bg-success" role="progressbar"
                                         style="width: 60%" aria-valuenow="60" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div className="d-flex justify-content-end flex-shrink-0">

                                <router-link :to="{name: 'taskDetails', params: { id: 123 }}" className="badge badge-light-success fs-8 fw-bolder me-1">
                                    التفاصيل
                                </router-link>
                            </div>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div className="d-flex align-items-center">

                                <div className="d-flex justify-content-start flex-column">
                                    <a href="#" className="text-dark fw-bolder text-hover-primary fs-6">Natali
                                        Goodwin</a>
                                    <span className="text-muted fw-bold text-muted d-block fs-7">Python, PostgreSQL, ReactJS</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <a href="#" className="text-dark fw-bolder text-hover-primary d-block fs-6">The
                                Hill</a>
                            <span className="text-muted fw-bold text-muted d-block fs-7">Insurance</span>
                        </td>
                        <td className="text-end">
                            <div className="d-flex flex-column w-100 me-2">
                                <div className="d-flex flex-stack mb-2">
                                    <span className="text-muted me-2 fs-7 fw-bold">50%</span>
                                </div>
                                <div className="progress h-6px w-100">
                                    <div className="progress-bar bg-warning" role="progressbar"
                                         style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div className="d-flex justify-content-end flex-shrink-0">
                                <router-link :to="{name: 'taskDetails', params: { id: 123 }}" className="badge badge-light-success fs-8 fw-bolder me-1">
                                    التفاصيل
                                </router-link>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
</template>

<script>
export default {
    name: "myTasks"
}
</script>


