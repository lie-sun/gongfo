const util = require("../../utils/util.js");
const md5 = require("../../utils/md5.js");
Page({
  data: {
    item: {
      footerNum: 1
    },
    musicPlay:true,
    gfflag:false,
    sxflag:true,
    hp:"../../images/hp_no.png",
    gp:"../../images/gp_no.png",
    xl:'../../images/xl_no.png',
    yanflag:false

  },
  /**
   * 底部导航按钮事件
   */
  tab1: function (params) {
    return;
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
  onLoad: function (params) {
    
  },
  onShow:function (params) {
    var gf_info = wx.getStorageSync('gf_info').gp_info;
    if (!gf_info) {
      return false;
    }
    var date = new Date();
    var new_time = md5(date.getMonth() + 1 + "" + date.getDate());
    if (new_time == gf_info.time) {
      this.setData({
        sxflag: false,
        gfflag:true,
        hp: gf_info.Flower,
        gp: gf_info.Fruit,
        xl: gf_info.Incense,
        yanflag:true
      })
    }

    this.playMusic();
    wx.onBackgroundAudioStop(function (params) {
      this.playMusic();
    })
  },
  playMusic:function (params) {
    wx.playBackgroundAudio({
      dataUrl:util.index_music
    })
  },
  closeMusic:function (params) {
    wx.pauseBackgroundAudio();
  },
  onHide:function (params) {
     wx.pauseBackgroundAudio();
  },
  play:function (params) {
   this.playMusic();
    this.setData({
      musicPlay: true
    })
  },
  pause:function (params) {
    wx.pauseBackgroundAudio();
    this.setData({
      musicPlay:false
    })
  },
  shangxiang:function (params) {
    wx.navigateTo({
      url:"../gongpin/gongpin"
    })
  }
})