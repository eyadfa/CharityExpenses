export default {
    title: function(title ,type){
        let types= {
            tyftv:"مرئية طيف",
            hayatv:"مرئية حياة",
            lebanontv:"مرئية لبنان",
            hettynradio:"اذاعة حطين",
            tyfradio:"اذاعة طيف",
        };
        return title  + " - " +  types[type];
    },
    code: function(type){
        let types= {
            tyftv:1,
            hayatv:2,
            lebanontv:3,
            hettynradio:4,
            tyfradio:5,
        };
        return  types[type];
    },
    types: function(type){
        let types= {
            1:"tyftv",
            2:"hayatv",
            3:"lebanontv",
            4:"hettynradio",
            5:"tyfradio",
        };
        return  types[type];
    }
};
