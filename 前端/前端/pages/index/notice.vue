<template>
	<view class="">
	 <rich-text type="text" :nodes="demoHtml"></rich-text>
	</view>
</template>

<script>
	var graceRichText = require("../../components/richText.js");
	export default {
	data() {
		return {
			demoHtml : '',
			tid:''
	    }
	},
	onLoad(event){
		//this.title = event.title
		//this.demoHtml = graceRichText.format(event.title);
		this.tid =  event.tid
		var _self = this;
		_self.$uniApi.checkPhone("");
		this.getlist();
	},
	methods: {
			getlist(){
				uni.request({
					url: this.$serverUrl + '/App/Zm/noticex',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						tid:this.tid
					},
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret) {
							// 取数据并赋值
							
							this.demoHtml = graceRichText.format(ret.data.msg.content);
						} else {
							console.log('未取得数据');
						}
						uni.stopPullDownRefresh();
					}
				});
			}
		}
	} 
</script>

<style>
	page {background-color: #fff;color:#000;}
</style>
