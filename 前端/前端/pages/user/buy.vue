<template>
	<view>
		<view v-if="buyg!=2"> 
			<ad  v-if="gezi!=0" :unit-id="gezi" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
		</view>
		
		
		<view class="m-kc-operation" v-for="(item,index) in indexList" :key="index" @click="openWin(item.tid,item.title)">
			<view style="width:100%;height:5px;background:#f5f5f5"></view>
		<view style="display: block;padding: 10px 15px;">
			<image :src="item.picname" style="width: 98px;height: 55px;float: left;border-radius: 3px;"></image>
			<view class="" style="padding-left: 105px;height: 55px;">
				<view class="biao">{{item.title}}</view>
				<view style="line-height: 30px;font-size: 14px;color: #999;">
					
				</view>
			</view>
		</view>
		<view  class="m-kc-operation-sj">
			<view style="display: inline-block;color: #999;">{{item.addtime | timeStamp}}</view>
			<view class="quxuexi" @click="copy(item.dizhi)">
				复制连接
			</view>
		</view>
		
	</view>
	<view class="load-more" style="text-align: center;color: rgba(41, 43, 51, 0.4);font-size: 10px;">
		{{load}}
	</view>
	
	
	
	
		<view style="width: 100%;height:auto;overflow-y: scroll;background-color: #fff;background-repeat: no-repeat;background-size: cover;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;flex-direction: column;-webkit-box-align: center;align-items: center;padding-top: 3rem;margin-top:20%;" v-if="wu">
			<image  src="../../static/image/w.png" style="width:120px;height:120px;">
		<view style="color:#000;margin-top: 20px;">暂无数据 !</view>
		</view>	
	</view>
</template>

<script>
	// 引入文件
	 import uniCopy from '@/js_sdk/xb-copy/uni-copy.js'
	export default {
		data() {
			return {
				indexList:'',
				indexList2: [],
				wu:false,
				load: "上拉加载更多",
				page:0,
				gezi:'',
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
					url: this.$serverUrl + '/App/zm/buylist',
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
			this.buyg = uni.getStorageSync('buyg');
		}, 
		methods: {
				copy(value) {
				  uniCopy({
					  content:value,
					  success:(res)=>{
						  uni.showToast({
							title: '复制成功！',
							icon: 'none',
							duration: 2000,
						  });
					  }
				  })
			    },
				selectIndextype() { 
				const user_id = uni.getStorageSync('user_id');
				uni.request({
					url: this.$serverUrl + '/App/zm/buylist',
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
	page{background-color: #fff;}
	.quxuexi {
	    font-size: 12px;
	    color: #fff;
	    background: #ff700a;
	    line-height: 18px;
	    padding: 2px 10px !important;
	    border-radius: 15px;
	    margin-top: 5px;
		float: right;
	}
	.m-kc-operation-sj{
		overflow: hidden;margin: 0 15px;font-size: 14px;height: 32px;line-height: 30px;border-top: 1px solid #f5f5f5;
	}
	.m-kc-operation{
		background: #fff;/* margin-top: 5px; */
	}
	.biao{
		height: 22px;line-height: 22px;font-size: 14px;color: #333;padding-top: 5px;text-overflow: ellipsis;white-space: nowrap;overflow: hidden;
	}
</style>
