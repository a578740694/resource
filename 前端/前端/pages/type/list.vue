<template>
	<view>
		
		<view class="postlist-bg" >
			<block v-for="(item,index) in indexList" :key="index" >
				<view class="menu-scroll-list" @click="openWin(item.id,item.title)">
					<view class="menu-scroll-list-img">
						
						
							<image class="fengrui-img" :src="item.picname"></image>
						
					</view>
					<view class="menu-scroll-list-right">
						<view class="menu-scroll-list-h">
							{{ item.title}}
						</view>
						<view class="list-li-tag"  v-if="item.type==1 || item.type==2 || item.type==5">
							权限：免费
						</view>
						<view class="list-li-tag"  v-if="item.type==3">
							权限：VIP专享
						</view>
						<view class="list-li-tag"  v-if="item.type==4">
							积分：{{item.price}}
						</view>
						<view class="menu-scroll-list-describe">
							<!-- <view class="">@{{ searchTag[0].name }}</view> -->
							<view style="font-size: 10px;">{{item.addtime | timeStamp}}</view>
						</view>
					</view>
				</view>
				<!-- #ifdef MP-WEIXIN -->
				<view v-if="lists!=2">
				 <block v-if="index%8==7">
					<view style="margin: 0upx 20upx;">
						<ad v-if="banner!=0" :unit-id="banner" class="lunbo-box"> </ad>
					</view>
				</block> 
				</view>
				<!-- #endif -->
		
				
			</block>
			<view class="load-more" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">
				{{load}}
			</view>
		</view>
		
			<view style="width: 100%;height:auto;overflow-y: scroll;background-repeat: no-repeat;background-size: cover;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;padding-top: 3rem;margin-top:20%;" v-if="wu">
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
				indexList2: [],
				wu:false,
				load: "上拉加载更多",
				page:0,
				tid:''
			}
		},
		filters: {
			timeStamp: function(value) {
				if (!value) return '';
				var now = new Date(value* 1000);
				//console.log("time:" + JSON.stringify(now));
				var year = now.getFullYear();
				var month = now.getMonth() + 1;
				if (month < 10) {
					month = '0' + month
				}
				var date = now.getDate();
				if (date < 10) {
					date = '0' + date
				}
				return year + "-" + month + "-" + date
			},
		},
		onReachBottom() {
			this.page = this.page + 10;
			console.log(this.page);
		//	console.log(this.type);
			if (this.load != "上拉加载更多") {
				return;
			}  
			this.load = "加载中...";
			setTimeout(() => {
				uni.request({
					url: this.$serverUrl + '/App/zm/all',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						nextrow:this.page,
						tid:this.tid
					},
					success: (ret) => {
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						
						if(ret){
							if (ret.data.code==1) {
								// 取数据并赋值
								this.indexList2 = ret.data.msg;
								this.indexList.push(...this.indexList2);
								this.wu = false;
								this.load = "上拉加载更多";
							} else {
								
								this.load = "~~·我是有底线的人·~~";
							}
						}else{
							this.wu = true;
						}
						uni.stopPullDownRefresh();
					}
				});
			}, 2000);
		},
		onLoad(event) {
			uni.showLoading({
				title: '加载中',
				mask: true
			});
			setTimeout(()=>{
				uni.hideLoading()
			},1000)
			this.tid =event.tid;
			this.selectIndextype();
			var _self = this;
			_self.$uniApi.checkPhone("");
		}, 
		methods: {
				selectIndextype() { // 取视频数据
				uni.request({
					url: this.$serverUrl + '/App/zm/leibiao',
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
						if(ret){
							if (ret.data.code==1) {
								// 取数据并赋值
								this.indexList = ret.data.msg;
								this.wu = false;
							} else if(ret.data.code==0) {
								this.indexList = '';
								this.load = "";
								this.wu = true;
							}
						}else{
							this.wu = true;
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
	page{background-color: #F7F7F7;}
		.aui-list-theme-box {padding: 10px 0 0 1rem;overflow: hidden;position: relative;}
		.aui-list-item {width: 46%;float: left;margin: 0 4% 2% 0;background: #fff;display: block;overflow: hidden;}
		.aui-list-theme-img {height:120px;width: 100%;position: relative;}
		.aui-list-theme-message {background: #fff;padding: 0.3rem 0;}
		.aui-list-theme-title {color: #333;font-size: 0.92rem;margin: 0.2rem 0;overflow: hidden;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;word-break: break-all;font-weight: normal;text-overflow: ellipsis;}
		/* .ico_common {display: block;position: absolute;right: 0;top: 0;width: 40px;height: 40px;background-repeat: no-repeat;background-position: center center;background-size: 100%;background-image: url(../../static/image/new.png);} */
		.learned {display: inline-block;background-color: rgba(0, 0, 0, 0.5);padding: 3px 6px;font-size: 10px;position: absolute;color: white;font-weight: normal;bottom: 1px;right: 1px;-webkit-border-radius: 5px;-moz-border-radius: 5px; border-radius: 5px;}
		
		.postlist-bg { 
			background-color: #FFFFFF;
			border-radius: 30upx;
			overflow: hidden;
			margin: 20upx;
			
		}
		/* 内容数据 */
		.menu-scroll-list-describe {
			color: #ADADAD;
			font-size: 20upx;
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 1;
			-webkit-box-orient: vertical;
		}
		
		.list-li-tag {
			color: #0BBDA6;
			font-size: 20upx;
		}
		
		.menu-scroll-list-h {
			font-size: 28upx;
			overflow: hidden;
			text-overflow: ellipsis;
			display: -webkit-box;
			-webkit-line-clamp: 2;
			-webkit-box-orient: vertical;
		}
		
		.menu-scroll-list-right {
			margin-left: 32upx;
			width: 420upx;
			display: flex;
			justify-content: space-between;
			flex-flow: column;
		}
		
		.menu-scroll-list-img {
			width: 360upx;
			height: 160upx;
			border-radius: 16upx;
			overflow: hidden;
		}
		
		.menu-scroll-list {
			display: flex;
			margin: 20upx 20upx;
		}
		
	.fengrui-img {
			width: 100%;
			height: 100%;
		}
</style>
