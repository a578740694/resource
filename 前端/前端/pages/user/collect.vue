<template>
	<view>
		<view v-if="cong!=2">
			<ad  v-if="gezi!=0" :unit-id="gezi" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
		</view>
		
		
		<view class="aui-block-list"  v-for="(item,index) in indexList" :key="index" @click="openWin(item.id,item.title)">
					<view class="aui-flex" >
						<view style="width: 150px;height:100px;margin-right: 1rem;">
							<image :src="item.picname" style="width:100%;height:100px;">
						</view>
						<view class="aui-flex-box">
							<view class="h2">
								{{item.title}}
							</view>
							<!-- <view  style="width: 100%;display: block;">
								<em style="font-style: normal;color: #34cd65;" v-if="item.price==0 || item.price== ''">免费</em>
		<em style="font-style: normal;color: red;" v-if="item.price!=0 && item.price!= '' ">￥{{item.price}}</em>
								<em style="font-style: normal;color: #999;float: right;font-size: 0.7rem;">{{item.count}}人气</em>
							</view> -->
						</view>
					</view>
				</view>
				<view class="load-more" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">
					{{load}}
				</view>
				<!-- <view class="" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">~~·我是有底线的人·~~</view> -->
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
				indexList2: [],
				wu:false,
				load: "上拉加载更多",
				page:0,
				gezi:''
			}
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
					url: this.$serverUrl + '/App/zm/collectlist',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						nextrow:this.page,
						uid:user_id
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
		onLoad() {
			this.selectIndextype();
			var _self = this;
			_self.$uniApi.checkPhone("");
			this.gezi = uni.getStorageSync('gezi');
			this.cong = uni.getStorageSync('cong');
		}, 
		methods: {
				selectIndextype() { 
				const user_id = uni.getStorageSync('user_id');
				uni.request({
					url: this.$serverUrl + '/App/zm/collectlist',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						uid:user_id
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
								this.load = "~~·我是有底线的人·~~";
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
	.aui-flex {display: flex;-webkit-box-align: center;align-items: center;padding: 0px 10px 5px 7px;position: relative;}
	
	
	.aui-flex-box {-webkit-box-flex: 1;flex: 1;min-width: 0;font-size: 14px;color: #333;}
	.h2 {font-size: 0.9rem;color: #323232;margin-bottom: 0.9rem;}
	
</style>
