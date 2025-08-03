"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_workshops_form_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=script&lang=js":
/*!********************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=script&lang=js ***!
  \********************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "followupForm",
  data: function data() {
    return {
      title: "ورشة عمل جديدة",
      form: {
        "id": 0,
        "name": "",
        "sourcex": -1
      }
    };
  },
  methods: {
    submit: function submit() {
      this.$swal('تم الحفظ بنجاح');
      this.$router.back();
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c":
/*!************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c ***!
  \************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* binding */ render)
/* harmony export */ });
/* harmony import */ var vue__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue */ "./node_modules/vue/dist/vue.esm-bundler.js");

var _hoisted_1 = {
  "class": "row gy-5 g-xl-8"
};
var _hoisted_2 = {
  "class": "col-12"
};
var _hoisted_3 = {
  "class": "card"
};
var _hoisted_4 = {
  "class": "card-header card-header-stretch"
};
var _hoisted_5 = {
  "class": "mt-5"
};
var _hoisted_6 = {
  "class": "card-body"
};
var _hoisted_7 = {
  "class": "form",
  method: "post"
};

var _hoisted_8 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"row mb-5\"><div class=\"col-md-12 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">اسم المؤتمر </label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-12 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">دور المؤسسة في المؤتمر </label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-2 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">تاريخ انعقاد المؤتمر </label><input type=\"date\" class=\"form-control form-control-solid\"></div><div class=\"col-md-6 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">مكان الانعقاد</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-2 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">عدد أيام المؤتمر </label><input type=\"number\" class=\"form-control form-control-solid\"></div><div class=\"col-md-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">محاور المشاركة</label><textarea class=\"form-control form-control-solid\" rows=\"5\"></textarea></div><div class=\"col-md-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">المخرجات</label><textarea class=\"form-control form-control-solid\" rows=\"5\"></textarea></div><div class=\"col-md-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\"> ملاحظات</label><textarea class=\"form-control form-control-solid\" rows=\"5\"></textarea></div></div><hr><div class=\"row\"><div class=\"col-md-3 fv-row border-gray-300 border-end-dashed border-gray-300 border-start-dashed\"><label> الأعضاء المكلفون بالمتابعة:</label><div class=\"row\"><div class=\"col-md-10 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">الاسم</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-2 fv-row\"><button class=\"btn btn-primary btn-icon mt-10 btn-sm\"><span class=\"fa fa-plus\"></span></button></div></div><table class=\"table-striped table table-bordered table-responsive\"><thead><tr><th>الاسم</th><th>....</th></tr></thead><tbody><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr></tbody></table></div><div class=\"col-md-3 fv-row border-gray-300 border-end-dashed\"><label> الأعضاء المكلفون بالمشاركة:</label><div class=\"row\"><div class=\"col-md-10 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">الاسم</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-2 fv-row\"><button class=\"btn btn-primary mt-10 btn-sm btn-icon\"><span class=\"fa fa-plus\"></span></button></div></div><table class=\"table-striped table table-bordered table-responsive\"><thead><tr><th>الاسم</th><th>....</th></tr></thead><tbody><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr><tr><td>محمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr></tbody></table></div><div class=\"col-md-6 p-2 fv-row border-gray-300 border-end-dashed\"><label class=\"mb-2\">المرفقات </label><div class=\"row\"><div class=\"col-11 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">عنوان المرفق</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-md-1\"><button class=\"btn btn-primary btn-icon mt-10 btn-sm\"><span class=\"fa fa-plus\"></span></button></div><div class=\"col-12 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">تفاصيل المرفق</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\">تاريخ المرفق</label><input type=\"date\" class=\"form-control form-control-solid\"></div><div class=\"col-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\"> الجهة المدخلة</label><input type=\"text\" class=\"form-control form-control-solid\"></div><div class=\"col-4 fv-row\"><label class=\"required fs-5 fw-bold mb-2\"> المرفق</label><input type=\"file\" class=\"form-control form-control-solid\"></div></div><table class=\"table-striped table table-bordered table-responsive\"><thead><tr><th>عنوان المرفق</th><th> التفاصيل </th><th>التاريخ </th><th> الجهة المدخلة</th><th>المرفق</th></tr></thead><tbody><tr><td>كلمة ممثل المؤسسة</td><td>كلمة مصورة في اليوم الثاني من المؤتمر</td><td>12/11/2022</td><td>محمد أحمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-search text-primary\"></span></button><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr><tr><td>كلمة ممثل المؤسسة</td><td>كلمة مصورة في اليوم الثاني من المؤتمر</td><td>12/11/2022</td><td>محمد أحمد</td><td><button class=\"btn btn-sm\"><span class=\"fas fa-search text-primary\"></span></button><button class=\"btn btn-sm\"><span class=\"fas fa-trash text-danger\"></span></button></td></tr></tbody></table></div></div>", 3);

var _hoisted_11 = {
  "class": "d-flex flex-center"
};

var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "indicator-label"
}, "حفظ", -1
/* HOISTED */
);

var _hoisted_13 = [_hoisted_12];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.title), 1
  /* TEXT */
  )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", _hoisted_7, [_hoisted_8, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": "btn btn-primary",
    onClick: _cache[0] || (_cache[0] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.submit();
    }, ["prevent"]))
  }, _hoisted_13), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return _ctx.$router.back();
    }, ["prevent"])),
    "class": "btn btn-light me-3"
  }, "تراجع")])])])])])]);
}

/***/ }),

/***/ "./resources/js/components/workshops/form.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/workshops/form.vue ***!
  \****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _form_vue_vue_type_template_id_088cbe9c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./form.vue?vue&type=template&id=088cbe9c */ "./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c");
/* harmony import */ var _form_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./form.vue?vue&type=script&lang=js */ "./resources/js/components/workshops/form.vue?vue&type=script&lang=js");
/* harmony import */ var G_projects_ims_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");





const __exports__ = /*#__PURE__*/(0,G_projects_ims_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_form_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_form_vue_vue_type_template_id_088cbe9c__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/workshops/form.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/workshops/form.vue?vue&type=script&lang=js":
/*!****************************************************************************!*\
  !*** ./resources/js/components/workshops/form.vue?vue&type=script&lang=js ***!
  \****************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./form.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=script&lang=js");


/***/ }),

/***/ "./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c":
/*!**********************************************************************************!*\
  !*** ./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c ***!
  \**********************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_vue_vue_type_template_id_088cbe9c__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_vue_vue_type_template_id_088cbe9c__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./form.vue?vue&type=template&id=088cbe9c */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/workshops/form.vue?vue&type=template&id=088cbe9c");


/***/ })

}]);
