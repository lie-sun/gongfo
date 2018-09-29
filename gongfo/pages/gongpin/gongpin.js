const md5 = require('../../utils/md5.js');
Page({
    data: {
        flowerArr: [{
            name: "../../images/thumb_57317c0909dd5.png",
            thumb:""
        }, {
            name: "../../images/thumb_57317b563dd84.png",
            thumb:"../../images/whh.png"
        }, {
            name: "../../images/thumb_57317b6abfd70.png",
            thumb:"../../images/wjdh.png"
        }, {
            name: "../../images/thumb_57317b84479bf.png",
            thumb:'../../images/wwsl.png'
        }],
        incenseArr: [{
            name: "../../images/thumb_57317b3e649a9.png",
            thumb:"../../images/wpax.png"
        }, {
            name: "../../images/thumb_57317b1342ec0.png",
            thumb:"../../images/wxyx.png"
        }, {
            name: "../../images/thumb_57317af91c367.png",
            thumb:"../../images/wjkx.png"
        }, {
            name: "../../images/thumb_57317b2793454.png",
            thumb:"../../images/wzcx.png"
        }],
        fruitArr: [{
                name: "../../images/thumb_57317bc06e3f6.png",
                thumb:"../../images/wpg.png"
            },
            {
                name: "../../images/thumb_57317bad45d08.png",
                thumb: "../../images/wcz.png"
            },
            {
                name: "../../images/thumb_57317beb6b64e.png",
                thumb: "../../images/wtz.png"
            },
            {
                name: "../../images/thumb_57317bd407101.png",
                thumb: "../../images/whlg.png"

            },
        ],
        checkedFlower: "../../images/hp_no.png",
        checkedFlowerthumb: "",
        checkedIncense: "../../images/xl_no2.png",
        checkedIncensethumb: "",
        checkedFruit: "../../images/gp_no2.png",
        checkedFruitthumb: ""
    },
    selectFlower: function (params) {
        this.setData({
            checkedFlower: params.target.dataset.imgsrc,
            checkedFlowerthumb: params.target.dataset.thumbimg
        })
    },
    selectIncense: function (params) {
        this.setData({
            checkedIncense: params.target.dataset.imgsrc,
            checkedIncensethumb: params.target.dataset.thumbimg
        })
    },
    selectFruit: function (params) {
        this.setData({
            checkedFruit: params.target.dataset.imgsrc,
            checkedFruitthumb: params.target.dataset.thumbimg
        })
    },
    sure_gp: function (params) {
        var checkedFlower = this.data.checkedFlower;
        var checkedIncense = this.data.checkedIncense;
        var checkedFruit = this.data.checkedFruit;
        if (checkedFlower == "../../images/hp_no.png" || checkedIncense == "../../images/xl_no2.png" || checkedFruit == "../../images/gp_no2.png") {
            wx.showModal({
                title: "温馨提示",
                content: "请选择供品后确认",
                showCancel: false
            })
            return;
        }
        var date = new Date();
        var time = (date.getMonth() + 1) +""+ date.getDate();
        var gongpinArr={};
        gongpinArr.Flower = this.data.checkedFlowerthumb;
        gongpinArr.Incense = this.data.checkedIncensethumb;
        gongpinArr.Fruit = this.data.checkedFruitthumb;
        gongpinArr.time = md5(time);
        wx.setStorage({
            key:"gf_info",
            data:{
               gp_info:gongpinArr
            },
            success: (params)=> {  
                wx.redirectTo({
                    url:"../dedicationzs/dedicationzs"
                })
            }
        })
        
    }
})