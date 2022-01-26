<template>
	<view>
		<view  style=" width: 100%;position: relative;overflow: hidden;padding:10px; padding-top: 8px;padding-bottom: 0px;" v-if="faqg!=2">
		<ad  v-if="gezi!=0" :unit-id="gezi" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
		</view>
		<view  style=" width: 100%;position: relative;overflow: hidden;padding:10px; padding-top: 8px;">
			<view style="background: #fff;border-radius: 5px;padding-bottom: 5px;">
		
			<rich-text type="text" :nodes="demoHtml"></rich-text>
		</view>
	</view>
	</view>
</template>

<script>
	var graceRichText = require("../../components/richText.js");
	export default {
	data() {
		return {
			demoHtml:"",
			gezi:"",
			faqg:''
	    }
	},
	onLoad(e){ 
		this.demoHtml = uni.getStorageSync('wenti');
		var _self = this;
		_self.$uniApi.checkPhone("");
		this.gezi = uni.getStorageSync('gezi');
		this.faqg = uni.getStorageSync('faqg');
	},
	methods: {
		
	}
	} 
</script>

<style>
	page {background-color: #f5f5f5;color:#000;}
</style>
