<template >
	<!-- background-image: linear-gradient(to bottom,#212429,#2A2A38); -->
	<view>
		<view class="wrapper">
			<!-- 用户信息 -->
			<view class="my_top">
				<view class="my_top_c_b">
					<view class="user-tx">
						<image :src="userimg" mode="" style="width: 60px;height: 60px;border-radius: 50%;display: block;"></image>
						<view class="" style="width: 15px;height: 15px;position: absolute;bottom: 0;right: 6px;background: url(../../static/image/1.png) no-repeat;background-size: 15px 15px;border-radius: 50%;"></view>
					</view>
					<view class="m-user-title">{{usernc}}</view>
					
					<view class="user-yxw-vip-2" v-if="tishi">VIP将于：{{enddate| timeStamp}} 到期</view>
					<view class="user-yxw-vip-2" v-else>您目前还不是会员哦~</view>
				</view>
			</view>
			<!-- 用户信息end -->
			<view class="m-dwz-viptc">一次开通，全站资源免费下</view>
			<!-- 购买会员 -->
			
			<view class="post-form">
				<view class="recharge">
					
					<view class="pc-vip-list" :class="{ active: cityindex == 1 }" @tap="change(1,yiyue)">
						<view class="pc-vip-list2">
							<view class="pc-vip-name">
								一个月会员
							</view>
							 <view class="" style="font-size: 14px;color: #999;line-height: 20px;">积分兑换</view> 
						</view>
						<view class="money">
							<text style="font-size: 12px;font-weight: 700;color:#ff700a !important;">积分</text>{{yiyue}}
						</view>
					</view>
					
					<view class="pc-vip-list" :class="{ active: cityindex == 2 }" @tap="change(2,liuyue)">
						<view class="pc-vip-list2">
							<view class="pc-vip-name">
								六个月会员
							</view>
							<view class="" style="font-size: 14px;color: #999;line-height: 20px;">积分兑换</view>
						</view>
						<view class="money">
							<text style="font-size: 12px;font-weight: 700;color:#ff700a !important;">积分</text>{{liuyue}}
						</view>
					</view>
					
					<view class="pc-vip-list" :class="{ active: cityindex == 3 }" @tap="change(3,shier)">
						<view class="pc-vip-list2">
							<view class="pc-vip-name">
								十二个月会员
							</view>
							<view class="" style="font-size: 14px;color: #999;line-height: 20px;">积分兑换</view>
						</view>
						<view class="money">
							<text style="font-size: 12px;font-weight: 700;color:#ff700a !important;">积分</text>{{shier}}
						</view>
					</view>
					
					
				</view>
				<button class="button2" type="submit" @click="openSub()">确认兑换</button>
				
				<button class="button2" type="submit" @click="openKami()">激活卡密</button>
			</view>
			<!-- 购买会员end -->
			<view class="" style="font-size: 12px;margin-left:20px;margin-right: 30px;color:#9CA0B8;">
				
				<view style="font-size: 12px;">会员服务声明：</view>
				<text>1.在会员有效期内，用户可以免费学习本站的所有课程。</text>
				<br/>
				<text>2.重复兑换会员服务，会员有效期将在原有基础上顺延。</text>
				<br/>
				<text>3.禁止用户使用任何方式，利用本站资源，为他人提供有偿服务，一经发现，本站有权查封该账号，并追究法律责任。</text>
				
			</view>
			
			
		</view>
		
		
		
		
		
		
		 <!--  <view class="recharge-money-scroll">
		   	
		   	<view class="item" v-for="(item,index)  in tixian" :key="index" :class="{ item1: cityindex == index }" @tap="change(index,item)">
				<view>
		   		<view class="txt1">{{item}}金币</view>
		   		<view  class="txt3">￥{{item}}</view>
				</view>
		   	</view>

		   </view> -->
		
		
		
		
		<!-- <view class="" style="position:absolute;top: auto;bottom: 0;width:100%;" @click="submit()">
				<view class="" style="width:100%;height:1.3rem;background-color: #1B1B22;color:#73727A;font-size:12px;text-align:center;">
					支付即表示同意 <text style="color:#7E5CCA;"> 充值协议</text>
				</view> 
					<view class="" style="width:90%;text-align: center;background-color: #8F5CF6 !important;height: 2.5rem;color: #ffffff;vertical-align: middle;line-height:2.5rem;border-radius:60px; margin: auto;">
						申请提现
					</view>
					<view class="" style="width:100%;text-align: center;height:.8rem;color:#fff;border-radius:60px;">
						 
					</view>	
				</view> -->
		
		
		
		
	</view>
</template>

<script>
	export default { 
		data() {  
			return {
				cityindex:0,
				yiyue:'',
				liuyue:'',
				shier:'',
				b:'',
				hasLogin: false,
				usernc:'',
				userimg:'',
				tishi:'',
				enddate:'',
			
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
		onShow() {
			const user_id = uni.getStorageSync('user_id');
			if (user_id) {
				this.hasLogin = true;
				this.usernc = uni.getStorageSync('username');
				this.userimg = uni.getStorageSync('userimg');
				var viptime = uni.getStorageSync('viptime');
				var nowTime = Date.parse(new Date())/1000;
				this.enddate =viptime;
				if (viptime>nowTime) {
					this.tishi = true;
					//this.openHuo(tid,title,picname);
				}else{
					this.tishi = false;
				}
			}else{
				this.hasLogin = false;
				uni.navigateTo({
					url: '/pages/login/login'
				});
			}
		},
		onLoad() { 
			this.yiyue = uni.getStorageSync('yiyue');
			this.liuyue = uni.getStorageSync('liuyue');
			this.shier = uni.getStorageSync('shier');
			var _self = this;
			_self.$uniApi.checkPhone("");
		},
		methods: {
			change(e,b) {
			     this.cityindex = e;
				 this.b = b
				 console.log(this.b)
			  },openSub(){
				  if(this.b == ''){
				  	uni.showToast({
				  		title: '请选择购买会员时常！',
				  		duration: 2000,
				  		icon:"none"
				  	});
				  	return;
				    }
				const user_id = uni.getStorageSync('user_id');
				uni.showLoading({
					title: '开通中...',
					mask: true
				});
				
				uni.request({
					url: this.$serverUrl + '/App/Zm/buyvip',
					header: {
						'content-type': 'application/x-www-form-urlencoded', 
					},
					method: 'POST',
					data: {
						uid: user_id,
						price:this.b	
					},
					success: (ret) => {
						//console.log(JSON.stringify(ret.data));
						if (ret.statusCode !== 200) {
							console.log('请求失败', ret);
							return;
						}
						if (ret.data.code == 1) {
							// 取数据并赋值
		
		uni.setStorageSync('viptime', ret.data.msg);
		uni.setStorageSync('jifen', ret.data.brr);
							uni.showToast({
								title: '开通成功',
								icon: 'none',
								duration: 2000
							});
							// 关闭动画
							uni.hideLoading();
							// 跳转到首页
							
		
						} else {
							// 关闭动画
							uni.hideLoading();
							// 气泡提示
							uni.showToast({
								title: ret.data.msg,
								icon: 'none',
								duration: 2000
							});
						}
					}
						});
				
				
					
			  },openKami(){
				  uni.navigateTo({
				  	url: '/pages/user/kami'
				  });
			  }
		}
	}
	
</script>

<style>
	page{background-color:#fff;height:auto;}
	.wrapper {max-width: 640px;min-width: 320px;margin: 0 auto;}
	.my_top {padding: 25px 0;background: linear-gradient(to top,#ff700a,#F19E38);}
	.my_top_c_b {overflow: hidden;padding: 0 15px;}
	.user-tx {width: 60px;height: 60px;margin: 0 auto;position: relative;}
	.m-user-title {font-weight: 700;padding: 8px 0 5px 0;color: #fff;font-size: 24px;text-align: center;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
	.user-yxw-vip-2 {color: #fff;font-size: 14px;text-align: center;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;}
	.m-dwz-viptc {color: #666;line-height: 30px;font-size: 14px;padding: 12px 15px;background-color: #fff;}
	.post-form {padding: 0 15px 20px;background-color: #fff;}
	.pc-vip-list {height: 80px;position: relative;padding: 0 20px;background-color: #fff;border: #eee 1px solid;margin-bottom: 10px;border-radius: 5px;}
	.pc-vip-list2 {float: left;height: 80px;}
	.active {
	    border: #ff700a 1px solid !important;
	}
	.pc-vip-name {font-weight: 700;font-size: 18px;padding-top: 17px;padding-bottom: 5px;line-height: 22px;color:#ff700a !important}
	.money-nd-yj {font-size: 14px;color: #999;line-height: 20px;text-decoration: line-through;}
	.money {font-size: 28px;font-weight: 700;float: right;height: 80px;line-height: 80px;color:#ff700a !important;}
	.vip-zyxs-box {background-color: #fff;padding: 0 15px 10px;}
	.button2 {width: 100%;line-height: 46px;background: linear-gradient(to left,#ff700a,#F19E38);color: #fff;font-size: 18px;padding: 0;border: 0;border-radius: 3px;margin-top: 20px;}
	
	
	
	
	.item{width:31.2%;float: left;height:20vw;background-color: #212429;margin-right: .4rem;margin-top:5px;border-radius: .5rem;display: flex;align-items: center;justify-content: space-around;flex-direction: column;color: #9CA0B8; }
	.item1{width:31.2%;float: left;height:20vw;background-color: #8F5CF6;margin-right: .4rem;margin-top:5px;border-radius: .5rem;display: flex;align-items: center;justify-content: space-around;flex-direction: column;color: #fff; }
	.item2{width:31.2%;float: left;height:20vw;background-color: #212429;margin-right: .4rem;margin-top:5px;border-radius: .5rem;display: flex;align-items: center;justify-content: space-around;flex-direction: column;color: #fff;text-align: center; }
	.txt1{color: #fff;font-size:12px; text-align:center;}
	.txt3{font-weight: 700;font-size: 1rem;text-align:center;}
	
	
	
	
	
</style>
