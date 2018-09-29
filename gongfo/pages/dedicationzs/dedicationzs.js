Page({
    data:{
        item:{
            footerNum:0
        },
        // 用户名
        userName:'123'
    },
    /**
   * 底部导航按钮事件
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
        wx.redirectTo({
            url: "../durenxuefo/durenxuefo"
        })
    },
    pay:function (params) {
        wx.navigateTo({
            url:"../pay/pay"
        })  
    },
    onShareAppMessage:function (params) {
        return{
            title:"供佛",
            path:"/pages/index/index",
            imageUrl:"../../images/500.png",
            success:function (params) {
                wx.redirectTo({
                    url:"../index/index"
                })
            }
        }
    }
})