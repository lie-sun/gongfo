Page({
    data: {
        item: {
            footerNum: 4
        }
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
        wx.redirectTo({
            url: "../my/my"
        })
    },
    tab4: function (params) {
       
        return;
    },
})