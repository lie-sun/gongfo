const util = require("../../utils/toolkit.js").util;
Page({
    data: {
        item: {
            footerNum: 3
        },
        time:'',
        monthnum:3,
        continuenum:1,
        username:'用户昵称',
        gflist:[
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"},
            {time:"2018-04-16 14:28:55"}
        ]
    },
    /**
     * 底部导航按钮
     */
    tab1: function (params) {
        wx.redirectTo({
            url: "../index/index"
        })
    },
    tab2: function (params) {
        wx.redirectTo({
            url: "../jingjinbang/jingjinbang"
        })
    },
    tab3: function (params) {
        return;
    },
    tab4: function (params) {
        wx.redirectTo({
            url: "../durenxuefo/durenxuefo"
        })
    },
    onLoad:function (params) {
        
    },
    onShow:function (params) {
        var time =(Date.parse(new Date(util.laterTime()))-Date.parse(new Date()))/1000;
        this.setData({
            time: util.dateformat(time)
        })
        setInterval(()=>{
            var time = (Date.parse(new Date(util.laterTime())) - Date.parse(new Date())) / 1000;
            this.setData({
                time: util.dateformat(time)
            })
        },1000)
        
    }
})