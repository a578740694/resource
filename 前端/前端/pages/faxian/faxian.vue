<template>
	<view class="overfor-x"> 
			<!-- 搜索框 -->
			<view class="container">
				<uni-search-bar radius="10" placeholder="搜索一下，发现有趣资源" @confirm="search" />
			</view>
			
			<!-- 热搜-->
			<view class="swiper-list">
				<scroll-view class="" scroll-x="true">
					<view class="label-list" v-for="(item,index)  in resou" :key="index" @click="search(item)">
						{{item}}
					</view>
				</scroll-view>
			</view>
			
			<!-- #ifdef MP-WEIXIN -->
			<block v-if="indexg!=2">
				<!-- 唠叨一会 -->
				<view class="titel-h">
					猜你想玩
				</view>
				
				<view class="" style="margin: 0upx 30upx;">
				<ad v-if="gezi!=0" :unit-id="gezi" ad-type="grid" grid-opacity="0.8" grid-count="5" ad-theme="white"></ad>
				</view>
				
			</block>
			<!-- #endif -->
		<!-- 猜你想搜 -->
		<view class="titel-h">
			热门推荐
		</view>
			
		<!-- 列表 -->
		<block v-for="(item,index) in indexList" :key="index" >
			<view class="list-li"@click="openWin(item.id,item.title)">
				<view class="list-img">
					<image class="fengrui-img" :src="item.picname" mode="aspectFill"></image>
				</view>
				<view class="list-li-left">
					<view class="list-li-left-h">
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
					<view class="list-li-left-describe">
						
						<view style="font-size: 10px;">{{item.addtime | timeStamp}}</view>
					</view>
				</view>
			</view>
		</block>	
			
			<view  style="    width: 100%;position: relative;overflow: hidden;padding: 0 15px; padding-top: 10px;" v-if="indexs!=2">
				<view style="border-radius: 12px;padding-bottom: 5px;">
			<ad v-if="shipin!=0" :unit-id="shipin" ad-type="video" ad-theme="white"></ad>
			</view>
			</view>
			
			 
			
	</view>
</template>

<script>
	
	
	export default {
		data() {
			return {
				indexList:'',
				ss:'',
				aa: [],
				resou:[],
				gezi: '',
				indexg: '',
				indexs: '',
				shipin:''
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
		onLoad(event){
			uni.showLoading({
				title: '加载中',
				mask: true
			});
			setTimeout(()=>{
				uni.hideLoading()
			},1000)
			this.keyword =event.keyword;
			this.selectIndextype();
			var _self = this;
			_self.$uniApi.checkPhone("");
			var ss = uni.getStorageSync('resou');
			//console.log(JSON.stringify(ss));	
			var aa = ss.split(",");  
			this.resou = aa;
			this.gezi = uni.getStorageSync('gezi');
			this.shipin = uni.getStorageSync('shipin');
			this.indexg = uni.getStorageSync('indexg');
			this.indexs = uni.getStorageSync('indexs');
			
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
			},// 搜索触发
			search: function(e) {
				
				if(e.value==undefined){
					var json = e;
				}else{
					var json = e.value;
				}
				if (json == '') {
					uni.showToast({
						title: '请输入内容',
						mask: true,
						icon: 'success',
						duration: 1500
					});
				} else {
					uni.navigateTo({
						url: '/pages/index/scout?keyword=' + json
					})
				}
			},
		}
	}
</script>

<style>
	
	/* 没有数据时候 */
	.no-text {
		color: #e6e6e6;
		text-align: center;
		font-size: 24upx;
	}
	
	.no-img {
		margin: auto;
		height: 400upx;
		width: 400upx;
	}
	
	.no-datalist {
		margin: auto;
		overflow: hidden;
		margin-bottom: 60upx;
	}
	
	/* 列表 */
	.list-li-left-describe {
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
		color: #D5D5D5;
		font-size: 20upx;
		display: flex;
		justify-content: space-between;
	}
	
	.list-li-tag {
		color: #0BBDA6;
		font-size: 20upx;
	}
	
	.list-li-left-h {
	
		font-size: 26upx;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 1;
		-webkit-box-orient: vertical;
	}
	
	.list-li-left {
		margin-left: 32upx;
		flex-grow: 1;
		height: 120upx;
		display: flex;
		flex-flow: column;
		justify-content: space-between;
	}
	
	.list-img {
		height: 120upx;
		width: 140upx;
		border-radius: 14upx;
		overflow: hidden;
		flex-shrink: 0;
	}
	
	.list-li {
		display: flex;
		margin: 20upx 30upx;
		align-items: center;
		background-color: #fff;
		padding: 24upx;
		border-radius: 20upx;
	}
	
	/* 标题 */
	.title-h-ad {
		height: 240upx;
		border-radius: 16upx;
		margin: 48upx;
		overflow: hidden;
	}
	
	.titel-h {
		font-size: 28upx;
		margin: 38upx 30upx;
	}
	
	/* 标签 */
	.swiper-list {
		margin: 20upx 30upx 0upx 30upx;
		white-space: nowrap;
		width: 100%;
	}
	
	.label-list {
		height: 50upx;
		padding: 4upx 20upx;
		background: linear-gradient(90deg, rgba(67, 130, 235, 1) 0%, rgba(6, 189, 254, 1) 100%);
		border-radius: 100upx;
		margin-right: 40upx;
		color: #FFFFFF;
		font-size: 28upx;
		flex-shrink: 0;
		display: inline-block;
	}
	.container {
		/* margin: 0upx 40upx; */
		/* background-color: #FFFFFF; */
		/* border-radius: 20upx; */
	}
	
	.fengrui-img {
		height: 100%;
		width: 100%;
	}
	.overfor-x{
		overflow-x: hidden;
	}
	
	page {
		background-color: #F7F7F7;
		overflow-x: hidden;
	}
	
	/* 暗黑模式下应用的样式 */
	@media (prefers-color-scheme: dark) {
		page {
			background: #161616;
		}
		.list-li{
			background: #202020;
		}
		.uni-searchbar__box {
			border-color: #202020;
		
		}
	}
</style>
