import axios from "axios";
import shared from "./shared";

export default {
    // Properties
    _vw: null,

    // Getter for vw
    get vw() {
        return this._vw;
    },

    // Setter for vw
    set vw(value) {
        this._vw = value;
        shared.setTitle("IMS::" + this._vw.title)
    },

    store: async function (return_back = true) {
        let res = {};
        try {
            this.vw.loading = true;
            res = (await axios.post(this.vw.api_url, this.vw.form)).data;
            shared.notify(res.message, res.status)
            if (res.status) {
                if (return_back) {
                    this.vw.$router.back();
                }
            } else {
                this.vw.errors = res.data
            }
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.alert(msg)
            this.vw.errors = error.response.data.errors
            res = {
                status: false,
                code: error.response.status,
                message: msg /*message:error.message*/,
                data: error.response.data.errors
            }
        }
        this.vw.loading = false;
        return res;
    },


    update: async function (return_back = true) {
        let res = {};
        try {
            this.vw.loading = true;
            res = (await axios.post(this.vw.api_url + "/update/" + this.vw.form.id, this.vw.form)).data;
            shared.notify(res.message, res.status)
            if (res.status) {
                if (return_back) {
                    this.vw.$router.back();
                }
            } else {
                this.vw.errors = res.data
            }
            this.vw.loading = false
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.notify(msg, false)
            this.vw.errors = error.response.data.errors;
            res = {
                status: false,
                code: error.response.status,
                message: msg /*message:error.message*/,
                data: error.response.data.errors
            }
        }
        this.vw.loading = false
        return res;
    },

    storeMultiPart: async function (return_back = true) {
        let res = {};
        try {
            this.vw.loading = true;
            let form_data = new FormData();
            for (const prop in this.vw.form) {
                form_data.append(prop, this.vw.form[[prop]]);
            }
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            res = (await axios.post(this.vw.api_url, form_data, config)).data;
            shared.notify(res.message, res.status)
            if (res.status) {
                if (return_back) {
                    this.vw.$router.back();
                }
            } else {
                this.vw.errors = res.data
            }
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.alert(msg)
            this.vw.errors = error.response.data.errors
            res = {
                status: false,
                code: error.response.status,
                message: msg /*message:error.message*/,
                data: error.response.data.errors
            }
        }
        this.vw.loading = false
        return res;
    },

    updateMultiPart: async function (return_back = true) {
        let res = {};
        try {
            this.vw.loading = true;
            let form_data = new FormData();
            for (const prop in this.vw.form) {
                form_data.append(prop, this.vw.form[[prop]]);
            }
            const config = {
                headers: {'content-type': 'multipart/form-data'}
            }
            res = (await axios.post(this.vw.api_url + "/update/" + this.vw.form.id, form_data, config)).data;
            shared.notify(res.message, res.status)
            if (res.status) {
                if (return_back) {
                    this.vw.$router.back();
                }
            } else {
                this.vw.errors = res.data
            }
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.alert(msg)
            this.vw.errors = error.response.data.errors
            res = {
                status: false,
                code: error.response.status,
                message: msg /*message:error.message*/,
                data: error.response.data.errors
            }
        }
        this.vw.loading = false
        return res
    },

    finish: async function (form_finish) {
        try {
            this.vw.loading = true;
            let res = {};
            if (form_finish != null) {
                res = (await axios.post(this.vw.api_url + "/finish/" + form_finish.id, form_finish)).data;
            } else {
                res = (await axios.post(this.vw.api_url + "/finish/" + this.vw.form.id, this.vw.form)).data;
            }
            shared.notify(res.message, res.status)
            if (res.status) {
                this.vw.$router.back();
            } else {
                this.vw.errors = res.data;
            }
            this.vw.loading = false

        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.notify(msg, false)
            this.vw.errors = error.response.data.errors;
            //return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }
        this.vw.loading = false
    },

    reply: async function (form_reply) {
        try {
            this.vw.loading = true;
            let res = {};
            if (form_reply != null) {
                res = (await axios.post(this.vw.api_url + "/reply/" + form_reply.id, form_reply)).data;
            } else {
                res = (await axios.post(this.vw.api_url + "/reply/" + this.vw.form.id, this.vw.form)).data;
            }

            shared.notify(res.message, res.status)
            if (res.status) {
                this.vw.$router.back();
            } else {
                this.vw.errors = res.data;
            }
            this.vw.loading = false

        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.notify(msg, false)
            this.vw.errors = error.response.data.errors;
            //return {status:false, code:error.response.status, message:msg /*message:error.message*/,  data: error.response.data.errors}
        }
        this.vw.loading = false
    },

    certify: async function (api_add, item_id, form) {
        try {
            let res = (await axios.post(api_add + "/certify/" + item_id, form)).data;
            shared.notify(res.message, res.status)
            return res;
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.notify(msg, false)
            return {code: 500, status: false, message: error.message, data: error};
        }
    },

    search: async function (next) {//
        try {
            if (next == true) {
                this.vw.currentPage++;
            } else {
                this.vw.currentPage = 1;
            }
            this.vw.loading = true;
            let res = (await axios.post(this.vw.api_url + "/search?page=" + this.vw.currentPage, this.vw.form)).data;
            this.vw.results = res.data;
            this.vw.total = res.total;

        } catch (error) {
            //shared.alert(error.message);
            shared.alert(shared.getErrorMessage(error));
        }
        this.vw.loading = false;
    },

    active: async function (api_basic_url, form = {}) {
        try {
            let xx = (await axios.post(api_basic_url + "/active", form)).data;
            return xx;
        } catch (error) {
            return {code: 500, status: false, message: error.message, data: error};
        }
    },

    destroy: async function (item_id) {//
        try {
            return (await axios.delete(this.vw.api_url + "/" + item_id)).data;
        } catch (error) {
            return {code: 500, status: false, message: error.message, data: error};
        }
    },

    show: async function (item_id) {
        try {
            return (await axios.get(this.vw.api_url + "/show/" + item_id)).data;
        } catch (error) {
            return {code: 500, status: false, message: error.message, data: error};
        }
    },

    activate: async function (item_id) {//
        this.vw.loading = true;
        await this.activation(item_id, 1)
        await this.vw.search();
        this.vw.loading = false;

    },

    deactivate: async function (item_id) {//
        this.vw.loading = true;
        let form = {is_active: 0};
        await this.activation(item_id, 0)
        await this.vw.search();
        this.vw.loading = false;
    },

    activation: async function (item_id, is_active) {
        let form = {id: item_id, is_active: is_active};
        let res = null;

        try {
            res = (await axios.post(this.vw.api_url + "/activation", form)).data;
            shared.notify(res.message, res.status)
        } catch (error) {
            let msg = shared.getErrorMessage(error)
            shared.notify(msg, false)
            res = {status: false, code: error.response.status, message: error.message, data: error.response.data.errors}
            shared.alert(res.message)
        }
        return res
    },

    exportToExcel: function () {
        this.vw.loading = true;
        let file_name = this.vw.title;
        axios.post(this.vw.api_url + "/export", this.vw.form, {
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
                console.error(error);
                shared.alert(shared.getErrorMessage(error))
            });

        this.vw.loading = false;
    },

    async _delete(_id) {//
        const result = await this.vw.$swal({
            title: 'هل أنت متأكد من الحذف؟',
            showDenyButton: true,
            confirmButtonText: 'حذف ',
            denyButtonText: 'لا',
        });
        if (result.isConfirmed) {
            this.vw.loading = true;
            try {
                const res = await this.destroy(_id);

                if (res.status) {
                    this.vw.search();
                    shared.success(res.message)
                } else {
                    this.vw.$swal(res.message);
                }
            } catch (error) {
                console.error('An error occurred:', error);
                this.vw.$swal('حدث خطأ أثناء الحذف.');
            } finally {
                this.vw.loading = false;
            }
        }
        return false;
    }


}
