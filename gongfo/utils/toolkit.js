const util = {
    // 一位数转两位数
    toPairage: (argument) => {
        return argument > 9 ? argument : '0' + argument;
    },
    // 格式化日期
    formatDate: () => {
        var date = new Date();
        var year = date.getFullYear();
        var mon = date.getMonth()+1;
        var day = date.getDate();
        return this.toPairage(year)+'/'+this.toPairage(mon)+'/'+this.toPairage(day);
    },
    // 格式化时间
    formatTime:()=>{
        var date = new Date();
        var hour = date.getHours();
        var minute = date.getMinutes();
        var second = date.getSeconds();
        return this.toPairage(hour)+':'+this.toPairage(minute)+":"+this.toPairage(second);
    },
    laterTime : () => {
        var Year = new Date().getFullYear();
        var mons = new Date().getMonth() + 1;
        var Mon = mons >= 10
            ? mons
            : "0" + mons;
        var Day = new Date().getDate() >= 10
            ? new Date().getDate()
            : "0" + new Date().getDate();
        return Year + "/" + Mon + "/" + Day + " 23:59:59";
    },
    // 格式化时间戳

    dateformat : timeLength => {
        // 小时
        var hr = Math.floor(timeLength / 3600);
        hr = hr >= 10
            ? hr
            : "0" + hr;
        // 分钟
        var min = Math.floor(timeLength / 60 % 60);
        min = min >= 10
            ? min
            : "0" + min;
        // 秒
        var sec = Math.floor(timeLength % 60 + 1);

        sec = sec >= 10
            ? sec
            : "0" + sec;

        return hr + ":" + min + ":" + sec;
    }

}
module.exports={
    util:util
}