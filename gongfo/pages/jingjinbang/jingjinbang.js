Page({
    data: {
        item: {
            footerNum: 2
        },

        // 供佛天数
        gf_num: 0,
        // 用户昵称
        names: "善青橘",
        // 上榜人的姓名
        lists: [{
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            },
            {
                name: "王老五"
            }
        ],
        guizeFlag: false
    },
    /**
     * 底部导航事件
     */
    tab1: function (params) {
        wx.redirectTo({
            url: "../index/index"
        })
    },
    tab2: function (params) {
        return;
    },
    tab3: function (params) {
        wx.redirectTo({
            url: "../my/my"
        })
    },
    tab4: function (params) {
        wx.redirectTo({
            url: "../durenxuefo/durenxuefo"
        })
    },
    // 供佛规则
    guize: function (params) {

        this.setData({
            guizeFlag: true
        })
    },
    ok:function (params) {
        this.setData({
            guizeFlag: false
        })
    },
    paiwei:function (params) {
        wx.redirectTo({
            url:"../mypaiwei/mypaiwei"
        })
    }
})