import axios from "axios";
import { ElMessage } from 'element-plus'

export default {

    alert(msg){
        ElMessage({
            message: msg,
            grouping: true,
            type: 'error',
        })
    },
    success(msg){
        ElMessage({
            message: msg,
            grouping: true,
            type: 'success',
        })
    },
    notify(msg, type){
        switch(type){
            case 0:
            case false:
                this.alert(msg);
                break;
            case 1:
            case true:
                this.success(msg);
                break;
        }
    },
    setTitle(title){
      //document.title = "IMS:" + title;
      document.title = title;
    },
    codes: async function(ls) {
        try {
            return (await axios.get('/api/codes/sub/' + ls )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },
    activeCodes: async function(ls) {
        try {
            return (await axios.get('/api/codes/active/all' )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },

    departments: async function() {
        try {
            return (await axios.post('/api/departments/search' , null )).data.data;
        } catch (err) {
            console.error(err);
        }

    },

    branches: async function() {
        try {
            return (await axios.post('/api/arch/branch/search' , null )).data.data;
        } catch (err) {
            console.error(err);
        }

    },

    committes: async function() {
        try {
            return (await axios.post('/api/committees/search' )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },
    orgs: async function() {
        try {
            return (await axios.post('/api/mail/agent/external/search' )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },
    attendanceCategories: async function() {
        try {
            return (await axios.post('/api/hr/attendance_categories/search' )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },
    insuranceCategories: async function() {
        try {
            return (await axios.post('/api/hr/insurance_types/search',{is_active:1} )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },
    relativeTypes: async function() {
        try {
            return (await axios.post('/api/hr/affiliate_categories/search',{is_active:1} )).data.data;
        } catch (err) {
            console.error(err.toJSON());
            throw new Error(err.message);
        }

    },

    employees: async function(department_id=-1, contract_type_id=-1) {

        try {
            return (await axios.post('/api/arch/employees/search' , {
                department_id:department_id,
                contract_type_id:contract_type_id,
            }
            )).data.data;
        } catch (err) {
            return {code:500 , status:false , message: error.message , data: error};
        }

    },
    countries: async function() {
        try {
            return (await this.active('/api/countries')).data;
        } catch (err) {
            return {code:500 , status:false , message: error.message , data: error};
        }
    },
     cities: async function(country_id) {
        try {
            return (await axios.post('/api/cities/search', {country_id: country_id,is_active:1})).data.data;
        } catch (error) {
            return {code:500 , status:false , message: error.message , data: error};
        }
    },


    store : async function(api_add , form) {
        try {
            return (await axios.post(api_add, form)).data;
        } catch (error) {
            let msg= this.getErrorMessage(error)
            return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }
    },

    storeMultiPart : async function(api_add , formData) {
        try {
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            return (await axios.post(api_add, formData, config)).data;
        } catch (error) {
            console.log(error);
            let msg=this.getErrorMessage(error)
            return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }

    },

    updateMultiPart : async function(api_add ,item_id, formData) {
        try {
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            return (await axios.post(api_add + "/update/" + item_id , formData)).data;
        } catch (error) {
            let msg= this.getErrorMessage(error)
            return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }

    },

    update : async function(api_add, item_id , form) {
        try {
            return (await axios.post(api_add + "/update/" + item_id , form)).data;
        } catch (error) {
            let msg= this.getErrorMessage(error)
            return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }
    },

    certify : async function(api_add, item_id , form) {
        try {
            return (await axios.post(api_add + "/certify/" + item_id , form)).data;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },

    post : async function(api_url , form) {
        try {
            let xx = (await axios.post(api_url, form)).data;
            return xx;
        } catch (error) {
            return {status:false, code:error.response.status, message:this.getErrorMessage(error),  data: error.response.data.errors}
        }
    },

    get : async function(api_url) {
        try {
            let xx = (await axios.get(api_url)).data;
            return xx;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },

    search : async function(api_basic_url , form , page=1) {
        try {
            let xx = (await axios.post(api_basic_url + "/search?page=" + page, form)).data;
            return xx;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },

    active : async function(api_basic_url, form={}) {
        try {
            let xx = (await axios.post(api_basic_url + "/active", form)).data;
            return xx;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },
    destroy : async function(api_basic_url , item_id) {
        try {
            return (await axios.delete(api_basic_url + "/" + item_id)).data;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },
    show : async function(api_basic_url , item_id) {
        try {
            console.log(api_basic_url + "/show/" + item_id);
            return (await axios.get(api_basic_url + "/show/" + item_id)).data;
        } catch (error) {
            return {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
        }
    },
    activate: async function(api_basic_url , item_id){
        let form = {is_active:1};
        await this.update(api_basic_url,item_id,form);
    },
    deactivate: async function(api_basic_url , item_id){
        let form = {is_active:0};
        await this.update(api_basic_url,item_id,form);
    },

    ///new function
    activation: async function(api_basic_url , item_id,is_active){
        let form = {id:item_id,is_active:is_active};
        let res=null;
        try {
            res =  (await axios.post(api_basic_url + "/activation" , form)).data;
            this.success(res.message)
        } catch (error) {
            res= {status:false, code:error.response.status, message:error.message,  data: error.response.data.errors}
            this.alert(res.message)
        }
        return res
    },

    exportToExcel: function(api_url , form, file_name) {
            axios.post(api_url + "/export", form, {
                headers: {
                    'Accept': 'application/vnd.ms-excel'
                },
                responseType: 'arraybuffer' //<-- here
            })
                .then(response => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');
                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', file_name + '.xlsx');
                    document.body.appendChild(fileLink);
                    fileLink.click();
                })
                .catch(function (error) {
                    //console.error(error);
                    this.alert(this.getErrorMessage(error))
                });
    },

    download(file_path) {
        var filename = file_path.replace(/^.*[\\\/]/, '');
        let form={path: file_path};
        axios.post("/api/download" ,form ,{
            responseType: 'arraybuffer' //<-- here
        })
            .then(response => {
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');
                fileLink.href = fileURL;
                fileLink.setAttribute('download' ,filename);
                document.body.appendChild(fileLink);
                fileLink.click();
                fileLink.remove();
            })
            .catch(function (error) {
                console.error(error);
            });
    },
    today(){
        var currentDate = new Date();
        var currentDateWithFormat = new Date().toJSON().slice(0,10);//.replace(/-/g,'/');
        return currentDateWithFormat;
    },
    print(dev_id) {
        const divContents = document.getElementById(dev_id).innerHTML;
        const newWin = window.open('', '_blank');
        newWin.document.write(`
                <html>
                  <head>
                    <title>Print Div</title>
                    <style>
                     table {
                width: 100%;
                border-collapse: collapse;
              }
              th, td {
                padding: 8px;
                border-bottom: 1px solid #ddd;
              }
              th {
                background-color: #f5f5f5;
              }
              .striped-row {
                background-color: #f9f9f9;
              }
                    </style>
                  </head>
                  <body style="direction: rtl">
                    ${divContents}
                  </body>
                </html>
              `);
        newWin.document.close();
        newWin.print();
    },
    async _delete(_id,api_url,vw , msg="" , need_search =true) {
        const result = await vw.$swal({
            title: msg ==""? 'هل أنت متأكد من الحذف؟' :msg,
            showDenyButton: true,
            confirmButtonText: 'حذف ',
            denyButtonText: 'لا',
        });
        if (result.isConfirmed) {
            vw.loading=true;
            try {
                const res = await this.destroy(api_url, _id);
                vw.$swal(res.message);
                if (res.status && need_search) {
                    vw.search();
                }
            } catch (error) {
                console.error('An error occurred:', error);
                vw.$swal('حدث خطأ أثناء الحذف.');
            }finally {
                vw.loading=false;
            }
        }
        return false;
    },

    getformData(form , file){
        let form_data = new FormData();
        for (const prop in form) {
            form_data.append(prop, this.form[[prop]]);
        }
        if (file != null) {
            form_data.append("file_to_upload", this.file.file);
        }
        return form_data;
    },
    getErrorMessage(error){
        let msg="";
        switch (error.response.status){
            case 401:
                //unauthorized need to login again
                msg="قم بتسجيل الدخول مرة أخرى"
                break;
            case 403:
                msg="لا تمتلك  الصلاحيات اللازمة";
                break;
            case 405:
                msg="طريقة غير مدعومة يجب الاتصال بالمطور لمعالجة المشكلة";
                break;
            case 422:
                msg="خلل في البيانات المدخلة";
                //this.alert(error.response.data.errors);
                break;
            case 500:
                msg="خلل 500";
                break;
        }
        return msg;
    },





}
