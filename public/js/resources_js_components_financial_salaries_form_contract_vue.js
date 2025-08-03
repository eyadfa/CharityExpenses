"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_financial_salaries_form_contract_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js":
/*!**************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js ***!
  \**************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "insuranceTypeForm",
  data: function data() {
    return {
      title: "اعداد سند الراتب",
      form: {
        "id": 0,
        "name": ""
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

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7":
/*!******************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7 ***!
  \******************************************************************************************************************************************************************************************************************************************************************************************************/
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

var _hoisted_7 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createStaticVNode)("<div class=\"row mb-5\"><table id=\"departments_table\" class=\"table table-row-dashed table-row-gray-300 table-striped gs-0 gy-4\"><!--begin::Table head--><thead><th> اسم الموظف </th><th>الرقم الوظيفي</th><th> الراتب </th><th>قيمة خصم القرض</th><th> سداد سلفة</th><th>خصميات أخرى</th><th>علاوات أخرى</th><th>ملاحظات</th></thead><!--end::Table head--><!--begin::Table body--><tbody><tr><td>محمد احمد</td><td>123</td><td>1850</td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"text\" class=\"form-control\"></td></tr><tr><td>محمد احمد</td><td>123</td><td>1850</td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"text\" class=\"form-control\"></td></tr><tr><td>محمد احمد</td><td>123</td><td>1850</td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"number\" class=\"form-control\" value=\"0\"></td><td><input type=\"text\" class=\"form-control\"></td></tr></tbody><!--end::Table body--></table></div>", 1);

var _hoisted_8 = {
  "class": "d-flex flex-center"
};

var _hoisted_9 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "indicator-label"
}, "حفظ", -1
/* HOISTED */
);

var _hoisted_10 = [_hoisted_9];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.title), 1
  /* TEXT */
  )]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [_hoisted_7, (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    type: "submit",
    "class": "btn btn-primary",
    onClick: _cache[0] || (_cache[0] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.submit();
    }, ["prevent"]))
  }, _hoisted_10), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[1] || (_cache[1] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return _ctx.$router.back();
    }, ["prevent"])),
    "class": "btn btn-light me-3"
  }, "تراجع")])])])])]);
}

/***/ }),

/***/ "./resources/js/components/financial/salaries/form_contract.vue":
/*!**********************************************************************!*\
  !*** ./resources/js/components/financial/salaries/form_contract.vue ***!
  \**********************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _form_contract_vue_vue_type_template_id_04b75ed7__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./form_contract.vue?vue&type=template&id=04b75ed7 */ "./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7");
/* harmony import */ var _form_contract_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./form_contract.vue?vue&type=script&lang=js */ "./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js");
/* harmony import */ var G_projects_ims_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");





const __exports__ = /*#__PURE__*/(0,G_projects_ims_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_form_contract_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_form_contract_vue_vue_type_template_id_04b75ed7__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/financial/salaries/form_contract.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js":
/*!**********************************************************************************************!*\
  !*** ./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_contract_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_contract_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./form_contract.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=script&lang=js");


/***/ }),

/***/ "./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7":
/*!****************************************************************************************************!*\
  !*** ./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7 ***!
  \****************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_contract_vue_vue_type_template_id_04b75ed7__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_form_contract_vue_vue_type_template_id_04b75ed7__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./form_contract.vue?vue&type=template&id=04b75ed7 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/financial/salaries/form_contract.vue?vue&type=template&id=04b75ed7");


/***/ })

}]);
