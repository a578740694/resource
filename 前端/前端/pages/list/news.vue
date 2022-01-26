<template>
	<view>
		<view class="aui-list-theme-box">
			<!-- v-if="index+1%2==0" -->
			<view class="" v-for="(item,index) in indexList" :key="index" @click="openWin(item.id,item.title)">
			<view class="aui-list-item">
				<view class="aui-list-theme-img">
					<image :src="item.picname" style="width: 100%;height:120px;display: block;border: none;"></image>
					<view class="learned">{{item.count}}人浏览</view>
					<i class="ico_common ico-new"></i>
				</view>
				
				<view class="aui-list-theme-message">
					<view class="aui-list-theme-title" style="height:50px;">{{item.title}}</view>
					<p style="color: #f68f40;font-size: 0.99rem;font-weight: 500;height: 1.5rem;"  v-if="item.type==1 || item.type==2 || item.type==5">免费 </p>
					<p style="color: #f68f40;font-size: 0.99rem;font-weight: 500;height: 1.5rem;"  v-if="item.type==3">VIP专享</p>			<p style="color: #f68f40;font-size: 0.99rem;font-weight: 500;height: 1.5rem;"  v-if="item.type==4">积分 {{item.price}}</p>	
				</view>
			</view>
			
			<view v-if="lists!=2">
				<view class="aui-list-item"  style="width:96%;"v-if="index%8==7">
					<ad v-if="shipin!=0" :unit-id="shipin" ad-type="video" ad-theme="white"></ad>
				</view>
			</view>
			
			
		</view>
		
		
		
		</view>
		
		
		
		
		
		
				
				<view class="" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">~~·我是有底线的人·~~</view>
			<view style="width: 100%;height:auto;overflow-y: scroll;background-color: #fff;background-repeat: no-repeat;background-size: cover;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;padding-top: 3rem;margin-top:20%;" v-if="wu">
				<image  src="../../static/image/w.png" style="width:120px;height:120px;">
			<view style="color:#000;margin-top: 20px;">暂无数据 !</view>
			</view>	
				
				
	</view>
</template>

<script>
	
	
	export default {
		data() {
			return {
				indexList:'',
				wu:false,
				shipin:"",
				lists:''
			}
		},
		onLoad() {
			uni.showLoading({
				title: '加载中',
				mask: true
			});
			setTimeout(()=>{
				uni.hideLoading()
			},1000)
			this.selectIndextype();
			var _self = this;
			_self.$uniApi.checkPhone("");
			this.shipin =uni.getStorageSync('shipin');
			this.lists =uni.getStorageSync('lists');
		}, 
		methods: {
				selectIndextype() { // 取视频数据
				uni.request({
					url: this.$serverUrl + '/App/zm/zuixin',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {},
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret.data.code==1) {
							// 取数据并赋值
							this.indexList = ret.data.msg;
							this.wu = false;
						} else {
							this.wu = true;
							this.indexList = '';
						}
						uni.stopPullDownRefresh();
					}
				});
			},openWin(tid,title) {
			      uni.navigateTo({
			      	url: '/pages/details/details?tid='+tid+'&title='+title
			      });	
			}
		}
	}
</script>

<style>
	.aui-list-theme-box {padding: 10px 0 0 1rem;overflow: hidden;position: relative;}
	.aui-list-item {width: 46%;float: left;margin: 0 4% 2% 0;background: #fff;display: block;overflow: hidden;}
	.aui-list-theme-img {height:120px;width: 100%;position: relative;}
	.aui-list-theme-message {background: #fff;padding: 0.3rem 0;}
	.aui-list-theme-title {color: #333;font-size: 0.92rem;margin: 0.2rem 0;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;word-break: break-all;font-weight: normal;text-overflow: ellipsis;}
/* 	.ico_common {display: block;position: absolute;right: 0;top: 0;width: 40px;height: 40px;background-repeat: no-repeat;background-position: center center;background-size: 100%;background-image: url(../../static/image/new.png);} */
	.learned {display: inline-block;background-color: rgba(0, 0, 0, 0.5);padding: 3px 6px;font-size: 10px;position: absolute;color: white;font-weight: normal;bottom: 1px;right: 1px;-webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;}
	
</style>
