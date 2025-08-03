"use strict";
(self["webpackChunk"] = self["webpackChunk"] || []).push([["resources_js_components_mailing_mail_external_handle_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js":
/*!**********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js ***!
  \**********************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _common_FileUpload__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../../../_common/FileUpload */ "./resources/js/components/_common/FileUpload.vue");
/* harmony import */ var _common_codeSelect__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../_common/codeSelect */ "./resources/js/components/_common/codeSelect.vue");
/* harmony import */ var _src_shared__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../src/shared */ "./resources/js/src/shared.js");



/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "externalMailForm",
  components: {
    CodeSelect: _common_codeSelect__WEBPACK_IMPORTED_MODULE_1__["default"],
    FileUpload: _common_FileUpload__WEBPACK_IMPORTED_MODULE_0__["default"]
  },
  data: function data() {
    return {
      title: " المراسلات الخارجية",
      form: {
        id: 0,
        title: "",
        follow_up: false,
        is_archive: 0,
        is_read_only: 0,
        need_followup: 0
      },
      external_agents: [],
      employees_list: [],
      file: {},
      fileSelected: false,
      showFileSelect: false,
      href: "",
      edit_route: "editMailExternal",
      base_route: "mailExternal",
      api_edit: "/api/mail/mail/external/edit/",
      api_download: "/api/mail/mail/external/download/"
    };
  },
  created: function created() {
    this.employees_list = _src_shared__WEBPACK_IMPORTED_MODULE_2__["default"].employees();
    this.loadExternalAgent();
    this.edit();
    this.href = '/mail_view/' + this.$route.params.id;
  },
  methods: {
    edit: function edit() {
      var _this = this;
      this.$axios.get('/sanctum/csrf-cookie').then(function (response) {
        _this.$axios.get(_this.api_edit + "".concat(_this.$route.params.id)).then(function (response) {
          _this.form = response.data;
        })["catch"](function (error) {
          console.error(error);
        });
      });
    },
    loadExternalAgent: function loadExternalAgent() {
      var _this2 = this;
      this.$axios.get('/sanctum/csrf-cookie').then(function (response) {
        _this2.$axios.post('/api/mail/agent/external', {
          is_public_rel: 0
        }).then(function (response) {
          _this2.external_agents = response.data.data;
        })["catch"](function (error) {
          console.error(error);
        });
      });
    },
    download: function download(mail_id) {
      var _this3 = this;
      this.$axios.get('/sanctum/csrf-cookie').then(function (response) {
        _this3.$axios.post(_this3.api_download, _this3.form, {
          responseType: 'arraybuffer' //<-- here
        }).then(function (response) {
          var fileURL = window.URL.createObjectURL(new Blob([response.data]));
          var fileLink = document.createElement('a');
          fileLink.href = fileURL;
          fileLink.setAttribute('download', _this3.form.file_name);
          document.body.appendChild(fileLink);
          fileLink.click();
          fileLink.remove();
        })["catch"](function (error) {
          console.error(error);
        });
      });
    }
  }
});

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23 ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* binding */ render)
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
var _hoisted_8 = {
  "class": "row mb-5"
};
var _hoisted_9 = {
  "class": "row mt-5 p-5 bg-light-warning"
};
var _hoisted_10 = {
  "class": "d-flex align-items-center col-3"
};
var _hoisted_11 = {
  "class": "form-check form-check-custom form-check-solid me-10"
};
var _hoisted_12 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "form-check-label fw-bold"
}, "أرشيف", -1 /* HOISTED */);
var _hoisted_13 = {
  "class": "row bg-light-dark p-5 mt-5"
};
var _hoisted_14 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_15 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, "نوع المراسلة", -1 /* HOISTED */);
var _hoisted_16 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, null, -1 /* HOISTED */);
var _hoisted_17 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "-1"
}, "صادر", -1 /* HOISTED */);
var _hoisted_18 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "-1"
}, "وارد", -1 /* HOISTED */);
var _hoisted_19 = [_hoisted_16, _hoisted_17, _hoisted_18];
var _hoisted_20 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_21 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, "رقم المراسلة ", -1 /* HOISTED */);
var _hoisted_22 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_23 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, "الجهة المرسلة", -1 /* HOISTED */);
var _hoisted_24 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "-1"
}, null, -1 /* HOISTED */);
var _hoisted_25 = ["value"];
var _hoisted_26 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_27 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, "تاريخ المراسلة ", -1 /* HOISTED */);
var _hoisted_28 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_29 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, "الجهة المستقبلة", -1 /* HOISTED */);
var _hoisted_30 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, null, -1 /* HOISTED */);
var _hoisted_31 = ["value"];
var _hoisted_32 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_33 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "fs-5 fw-bold mb-2"
}, "متعلق بـ: ", -1 /* HOISTED */);
var _hoisted_34 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_35 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_36 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "تاريخ التذكير:", -1 /* HOISTED */);
var _hoisted_37 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_38 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", null, "آخر موعد للرد :", -1 /* HOISTED */);
var _hoisted_39 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_40 = {
  "class": "d-flex align-items-center col-3"
};
var _hoisted_41 = {
  "class": "form-check form-check-custom form-check-solid me-10"
};
var _hoisted_42 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "form-check-label fw-bold"
}, "للاطلاع", -1 /* HOISTED */);
var _hoisted_43 = {
  "class": "form-check form-check-custom form-check-solid"
};
var _hoisted_44 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("span", {
  "class": "form-check-label fw-bold"
}, "يحتاج للمتابعة", -1 /* HOISTED */);
var _hoisted_45 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_46 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "fs-5 fw-bold mb-2"
}, "المتابعة بواسطة", -1 /* HOISTED */);
var _hoisted_47 = ["disabled"];
var _hoisted_48 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: ""
}, null, -1 /* HOISTED */);
var _hoisted_49 = ["value"];
var _hoisted_50 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_51 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "fs-5 fw-bold mb-2"
}, "يحول إلى", -1 /* HOISTED */);
var _hoisted_52 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("option", {
  value: "-1"
}, null, -1 /* HOISTED */);
var _hoisted_53 = ["value"];
var _hoisted_54 = {
  "class": "col-md-12 fv-row"
};
var _hoisted_55 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "required fs-5 fw-bold mb-2"
}, " نص المراسلة", -1 /* HOISTED */);
var _hoisted_56 = {
  "class": "col-md-3 fv-row"
};
var _hoisted_57 = /*#__PURE__*/(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", {
  "class": "fs-5 fw-bold mb-2"
}, " المرفقات", -1 /* HOISTED */);
var _hoisted_58 = {
  key: 1,
  "class": "fw-bold d-block fs-6"
};
var _hoisted_59 = {
  "class": "d-flex flex-center"
};
var _hoisted_60 = ["href"];
function render(_ctx, _cache, $props, $setup, $data, $options) {
  var _component_code_select = (0,vue__WEBPACK_IMPORTED_MODULE_0__.resolveComponent)("code-select");
  return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("div", _hoisted_1, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_2, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_3, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_4, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("h2", _hoisted_5, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)($data.form.title), 1 /* TEXT */)]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_6, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("form", _hoisted_7, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_8, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_9, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_10, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("begin::Checkbox"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_11, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[0] || (_cache[0] = function ($event) {
      return $data.form.is_archive = $event;
    }),
    "class": "form-check-input h-20px w-20px",
    type: "checkbox",
    value: "1"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.form.is_archive]]), _hoisted_12]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("end::Checkbox")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_13, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_14, [_hoisted_15, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "class": "form-select form-select-solid",
    "onUpdate:modelValue": _cache[1] || (_cache[1] = function ($event) {
      return $data.form.sending_type_cd = $event;
    })
  }, [].concat(_hoisted_19), 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.sending_type_cd]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_20, [_hoisted_21, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[2] || (_cache[2] = function ($event) {
      return $data.form.message_code = $event;
    }),
    "class": "form-control form-control-solid",
    type: "number"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.message_code]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_22, [_hoisted_23, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[3] || (_cache[3] = function ($event) {
      return $data.form.sender_id = $event;
    }),
    "class": "form-select form-select-solid"
  }, [_hoisted_24, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.employees_list, function (c) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: c.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(c.full_name), 9 /* TEXT, PROPS */, _hoisted_25);
  }), 256 /* UNKEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.sender_id]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_26, [_hoisted_27, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "onUpdate:modelValue": _cache[4] || (_cache[4] = function ($event) {
      return $data.form.sending_date = $event;
    }),
    "class": "form-control form-control-solid",
    type: "date"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.sending_date]])])], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vShow, $data.form.is_archive == 1]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_28, [_hoisted_29, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[5] || (_cache[5] = function ($event) {
      return $data.form.receiver_id = $event;
    }),
    "class": "form-select form-select-solid"
  }, [_hoisted_30, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.external_agents, function (c) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: c.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(c.name), 9 /* TEXT, PROPS */, _hoisted_31);
  }), 256 /* UNKEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.receiver_id]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_32, [_hoisted_33, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "text",
    "class": "form-control form-control-solid",
    "onUpdate:modelValue": _cache[6] || (_cache[6] = function ($event) {
      return $data.form.related_to = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.related_to]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_34, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_code_select, {
    main_cd: 112,
    title: "نوع البريد",
    sub_cd: $data.form.mail_type_cd,
    "onUpdate:sub_cd": _cache[7] || (_cache[7] = function ($event) {
      return $data.form.mail_type_cd = $event;
    })
  }, null, 8 /* PROPS */, ["sub_cd"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_35, [_hoisted_36, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "onUpdate:modelValue": _cache[8] || (_cache[8] = function ($event) {
      return $data.form.reminder_date = $event;
    }),
    "class": "form-control form-control-solid"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.reminder_date]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_37, [_hoisted_38, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    type: "date",
    "onUpdate:modelValue": _cache[9] || (_cache[9] = function ($event) {
      return $data.form.last_response_date = $event;
    }),
    "class": "form-control form-control-solid"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.last_response_date]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_39, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createVNode)(_component_code_select, {
    is_required: false,
    main_cd: 113,
    title: " الأولوية:",
    sub_cd: $data.form.priority_cd,
    "onUpdate:sub_cd": _cache[10] || (_cache[10] = function ($event) {
      return $data.form.priority_cd = $event;
    })
  }, null, 8 /* PROPS */, ["sub_cd"])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_40, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("begin::Checkbox"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_41, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input h-20px w-20px",
    type: "checkbox",
    "onUpdate:modelValue": _cache[11] || (_cache[11] = function ($event) {
      return $data.form.is_read_only = $event;
    }),
    value: "1"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.form.is_read_only]]), _hoisted_42]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("end::Checkbox"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("begin::Checkbox"), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("label", _hoisted_43, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("input", {
    "class": "form-check-input h-20px w-20px",
    type: "checkbox",
    "onUpdate:modelValue": _cache[12] || (_cache[12] = function ($event) {
      return $data.form.need_followup = $event;
    })
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelCheckbox, $data.form.need_followup]]), _hoisted_44]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createCommentVNode)("end::Checkbox")]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_45, [_hoisted_46, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[13] || (_cache[13] = function ($event) {
      return $data.form.followed_by = $event;
    }),
    "class": "form-select form-select-solid",
    disabled: !$data.form.need_followup
  }, [_hoisted_48, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.employees_list, function (c) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: c.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(c.full_name), 9 /* TEXT, PROPS */, _hoisted_49);
  }), 256 /* UNKEYED_FRAGMENT */))], 8 /* PROPS */, _hoisted_47), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.followed_by]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_50, [_hoisted_51, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("select", {
    "onUpdate:modelValue": _cache[14] || (_cache[14] = function ($event) {
      return $data.form.redirect_to = $event;
    }),
    "class": "form-select form-select-solid"
  }, [_hoisted_52, ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(true), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)(vue__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,vue__WEBPACK_IMPORTED_MODULE_0__.renderList)($data.employees_list, function (c) {
    return (0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("option", {
      value: c.id
    }, (0,vue__WEBPACK_IMPORTED_MODULE_0__.toDisplayString)(c.full_name), 9 /* TEXT, PROPS */, _hoisted_53);
  }), 256 /* UNKEYED_FRAGMENT */))], 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelSelect, $data.form.redirect_to]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_54, [_hoisted_55, (0,vue__WEBPACK_IMPORTED_MODULE_0__.withDirectives)((0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("textarea", {
    "onUpdate:modelValue": _cache[15] || (_cache[15] = function ($event) {
      return $data.form.details = $event;
    }),
    "class": "form-control form-control-solid",
    rows: "10"
  }, null, 512 /* NEED_PATCH */), [[vue__WEBPACK_IMPORTED_MODULE_0__.vModelText, $data.form.details]])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_56, [_hoisted_57, $data.form.attachment_path != null ? ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("a", {
    key: 0,
    "class": "fw-bold d-block fs-6",
    onClick: _cache[16] || (_cache[16] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return $options.download($data.form.id);
    }, ["prevent"]))
  }, "عرض")) : ((0,vue__WEBPACK_IMPORTED_MODULE_0__.openBlock)(), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementBlock)("span", _hoisted_58, "لا يوجد مرفق "))])]), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("div", _hoisted_59, [(0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("a", {
    href: $data.href,
    target: "_blank",
    "class": "btn btn-warning"
  }, " معاينة ", 8 /* PROPS */, _hoisted_60), (0,vue__WEBPACK_IMPORTED_MODULE_0__.createElementVNode)("button", {
    onClick: _cache[17] || (_cache[17] = (0,vue__WEBPACK_IMPORTED_MODULE_0__.withModifiers)(function ($event) {
      return _ctx.$router.back();
    }, ["prevent"])),
    "class": "btn btn-light me-3"
  }, "تراجع")])])])])])]);
}

/***/ }),

/***/ "./resources/js/components/mailing/mail/external/handle.vue":
/*!******************************************************************!*\
  !*** ./resources/js/components/mailing/mail/external/handle.vue ***!
  \******************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _handle_vue_vue_type_template_id_35233f23__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./handle.vue?vue&type=template&id=35233f23 */ "./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23");
/* harmony import */ var _handle_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./handle.vue?vue&type=script&lang=js */ "./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js");
/* harmony import */ var _node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/dist/exportHelper.js */ "./node_modules/vue-loader/dist/exportHelper.js");




;
const __exports__ = /*#__PURE__*/(0,_node_modules_vue_loader_dist_exportHelper_js__WEBPACK_IMPORTED_MODULE_2__["default"])(_handle_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_1__["default"], [['render',_handle_vue_vue_type_template_id_35233f23__WEBPACK_IMPORTED_MODULE_0__.render],['__file',"resources/js/components/mailing/mail/external/handle.vue"]])
/* hot reload */
if (false) {}


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (__exports__);

/***/ }),

/***/ "./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js":
/*!******************************************************************************************!*\
  !*** ./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_handle_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__["default"])
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_handle_vue_vue_type_script_lang_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./handle.vue?vue&type=script&lang=js */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=script&lang=js");
 

/***/ }),

/***/ "./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23":
/*!************************************************************************************************!*\
  !*** ./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23 ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   render: () => (/* reexport safe */ _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_handle_vue_vue_type_template_id_35233f23__WEBPACK_IMPORTED_MODULE_0__.render)
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_use_0_node_modules_vue_loader_dist_templateLoader_js_ruleSet_1_rules_2_node_modules_vue_loader_dist_index_js_ruleSet_0_use_0_handle_vue_vue_type_template_id_35233f23__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!../../../../../../node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!../../../../../../node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./handle.vue?vue&type=template&id=35233f23 */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5.use[0]!./node_modules/vue-loader/dist/templateLoader.js??ruleSet[1].rules[2]!./node_modules/vue-loader/dist/index.js??ruleSet[0].use[0]!./resources/js/components/mailing/mail/external/handle.vue?vue&type=template&id=35233f23");


/***/ })

}]);