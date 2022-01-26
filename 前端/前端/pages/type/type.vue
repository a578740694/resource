<template>
	<view style="margin-top:5px;">
		<view style="width: 100%;padding: 0 15px;padding-bottom: .8rem;" v-if="typeb!=2">
		<ad v-if="banner!=0" :unit-id="banner" class="lunbo-box"> </ad>
		</view>
		<view class="shipin-ul" style="padding: 0 .8rem;">
			
			<view style="width: 100%;height: 10rem;border-radius: .5rem;overflow: hidden;background-color: #212429;position: relative;margin-bottom: .8rem;"  v-for="(list,index) in typeList" :key="index" @click="openWin(list.id)">
				<image class="shipin-img" :src="list.picname" style="width: 100%;height: 100%;"  >
					
				<view style="width: 100%;position: absolute;bottom: 0;left: 0;padding: .3rem;background-color: rgba(0,0,0,.3);font-weight: bold;">
					<view style="color: #fff;">{{list.title}}</view>
					 
				</view>	
					
			</view>
			
		</view>
		<view style="width: 100%;padding: 0 15px; " v-if="types!=2">
		<ad v-if="shipin!=0" :unit-id="shipin" ad-type="video" ad-theme="white"></ad>
		</view>
		<view style="width: 100%;height:auto;overflow-y: scroll;background-color: #fff;background-repeat: no-repeat;background-size: cover;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;padding-top: 3rem;margin-top:20%;" v-if="wu">
			<image  src="../../static/image/w.png" style="width:120px;height:120px;">
		<view style="color:#000;margin-top: 20px;">暂无数据 !</view>
		</view>
	</view>
</template>

<script>
	export default {
		components: {  
			
		},data() {
			return {
				title: 'Hello',
				typeList: [],
				wu:false,
				shipin:"",
				banner:'',
				typeb:'',
				types:''
				
			}
		},
		onLoad() {
			this.selectType();
			var _self = this;
			_self.$uniApi.checkPhone("");
			this.shipin =uni.getStorageSync('shipin');
			this.banner = uni.getStorageSync('banner');
			this.typeb =uni.getStorageSync('typeb');
			this.types =uni.getStorageSync('types');
		}, 
		methods: {
				selectType() { // 取轮播图数据
				uni.request({
					url: this.$serverUrl + '/App/zm/type',
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret) {
							if(ret.data.code==1){
								// 取数据并赋值
								this.typeList = ret.data.msg;
								this.wu = false;
							}else{
								this.wu = true;
								this.typeList = '';
							}
						} else {
							console.log('未取得数据');
						}
						uni.stopPullDownRefresh();
					}
				}); 
				
			},openWin(tid) {
			      uni.navigateTo({
			      	url: '/pages/type/list?tid='+tid
			      });
			}
		}
	}
</script>

<style>
	page{background-color: #fff;}
	.shipin-ul {
		width: 100%;
		display: flex;
		flex-wrap: wrap;
		text-align: center;
	}
	
	.shipin-li {
		width: 48%;
		display: flex;
		flex-direction: column;
		padding: 0.1rem 0.1rem;
	}
	
	.shipin-img {
		width: 95%;
		height: 7rem;
		margin: 0 auto;
		margin-bottom: 0.4rem;
	}
	
	.shipin-i {
		display: inline-block;
		width: 95%;
		font-size: 0.7rem;
		font-style: normal;
		color: #acacac;
		white-space: nowrap;
		text-overflow: ellipsis;
		overflow: hidden;
	}
	
</style>
