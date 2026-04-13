const plansJSON = document.querySelector("#investPlans");
const userJSON = document.querySelector("#user");
const adminJSON = document.querySelector("#admin");
const registerForm = document.querySelector("#reg-form");
const loginForm = document.querySelector("#login-form");
const verify2FA_form = document.querySelector("#verify2FA-form");
const forgotPasswordForm = document.querySelector("#forgot-pass-form");
const resetPasswordForm = document.querySelector("#reset-pass-form");
const logoutBtn = document.querySelectorAll(".logoutBtn");
const editProfileForm = document.querySelector("#edit-profile-form");
const radioBtn = document.querySelectorAll(".select-button input");
const depositForm = document.querySelector("#deposit-form");
const withdrawForm = document.querySelector("#withdraw-form");
const withdrawMethods = document.querySelectorAll(".withdraw-method .method");
const planCalcAmount = document.querySelector("#planCalc-amount");
const planCalcForm = document.querySelector("#calc-form");
const planCalcProfit = document.querySelector("#planCalc-profit");
const verifyEmail = document.querySelector("#email-verify-form");
const resendEmail = document.querySelector("#resend-email");
const changePassword = document.querySelector("#change_password");
const auth2FA = document.querySelector("#auth2FA");
const disable2FA = document.querySelector("#disable2FA");

// header fixed
// window.addEventListener("scroll", () => {
//   let header = document.querySelector("header");
//   if (header) {
//     if (window.scrollY > 1) {
//       header.classList.add("sticky");
//       document.querySelector(".tradingview-widget-container").style.display = "none";
//     } else {
//       header.classList.remove("sticky");
//       document.querySelector(".tradingview-widget-container").style.display = "block";
//     }
//   }
// });

const getIp = async () => {
  try {
    const res = await fetch("https://json.geoiplookup.io", { method: "GET" });
    const data = await res.json();
    if (data.success === true && document.querySelector("#currentIp")) {
      document.querySelector("#currentIp").textContent = data.ip;
      // document.querySelector("#country").textContent = data.country_name;
    }
  } catch (error) {
    console.log(error);
  }
};
// getIp();

function compressBase64Image(base64Image) {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.src = base64Image;
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    img.onload = () => {
      canvas.width = img.width;
      canvas.height = img.height;
      ctx.drawImage(img, 0, 0);
      const compressedBase64Image = canvas.toDataURL("image/jpeg", 0.2);
      resolve(compressedBase64Image);
    };
    img.onerror = () => {
      reject(new Error("Failed to load image"));
    };
  });
}

function compressBase64ImageToThumbnail(base64Image) {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.src = base64Image;
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    img.onload = function () {
      const MAX_WIDTH = 300;
      const MAX_HEIGHT = 300;
      let width = img.width;
      let height = img.height;

      if (width > height) {
        if (width > MAX_WIDTH) {
          height *= MAX_WIDTH / width;
          width = MAX_WIDTH;
        }
      } else {
        if (height > MAX_HEIGHT) {
          width *= MAX_HEIGHT / height;
          height = MAX_HEIGHT;
        }
      }

      canvas.width = width;
      canvas.height = height;

      ctx.drawImage(img, 0, 0, width, height);

      const compressedBase64Image = canvas.toDataURL("image/jpeg", 0.5);
      resolve(compressedBase64Image);
    };
    img.onerror = function () {
      reject(new Error("Failed to load image"));
    };
  });
}

async function reduceImageSize(base64Str) {
  const maxWidth = 450;
  const maxHeight = 450;
  let resized_base64 = await new Promise((resolve) => {
    let img = new Image();
    img.src = base64Str;
    img.onload = () => {
      let canvas = document.createElement("canvas");
      let width = img.width;
      let height = img.height;

      if (width > height) {
        if (width > maxWidth) {
          height *= maxWidth / width;
          width = maxWidth;
        }
      } else {
        if (height > maxHeight) {
          width *= maxHeight / height;
          height = maxHeight;
        }
      }
      canvas.width = width;
      canvas.height = height;
      let ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0, width, height);
      resolve(canvas.toDataURL()); // this will return base64 image results after resize
    };
  });
  return resized_base64;
}

function convertToBase64(file) {
  return new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = (error) => reject(error);
  });
}

// register
if (registerForm) {
  const getCountry = async () => {
    try {
      const res = await fetch("https://json.geoiplookup.io", { method: "GET" });
      const data = await res.json();
      if (data.success === true) {
        return data.country_name;
      }
    } catch (error) {
      console.log(error);
    }
  };
  let errorText = document.querySelector(".auth-error");
  const qs = new URLSearchParams(location.search);
  document.querySelector("#referrer").value = qs.get("ref") ? qs.get("ref") : "N/A";

  registerForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const firstName = e.target.firstName.value;
    const lastName = e.target.lastName.value;
    const username = e.target.username.value.trim();
    const email = e.target.email.value;
    const phone = e.target.phone.value;
    const password = e.target.password.value;
    const confirmPassword = e.target.password2.value;
    const referrer = qs.get("ref") ? qs.get("ref") : null;
    // const terms = e.target.terms;
    const country = await getCountry().catch((err) => console.log(err));

    // errorText.textContent = "";
    // errorText.style.color = "green";

    if (password !== confirmPassword) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";

      errorText.textContent = "Passwords do not match";
      setTimeout(() => {
        errorText.textContent = "";
      }, 4000);
      return;
    }
    // if (!terms.checked) {
    //   document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";

    //   errorText.textContent = "you must agree with the terms and conditions";
    //   setTimeout(() => {
    //     errorText.textContent = "";
    //   }, 4000);
    //   return;
    // }

    try {
      const res = await fetch("/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          firstName,
          lastName,
          username,
          email,
          country,
          phone,
          password,
          referrer,
        }),
      });
      const data = await res.json();
      console.log(data);
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
      } else {
        location.assign("/user/dashboard");
      }
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });
}

if (verifyEmail) {
  let errorText = document.querySelector(".auth-error");
  let errorText2 = document.querySelector(".auth-error2");
  verifyEmail.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const code_1 = e.target.email_code_1.value;
    const code_2 = e.target.email_code_2.value;
    const code_3 = e.target.email_code_3.value;
    const code_4 = e.target.email_code_4.value;
    const code_5 = e.target.email_code_5.value;
    const code_6 = e.target.email_code_6.value;

    const code = code_1.concat("", code_2, code_3, code_4, code_5, code_6);

    errorText.textContexnt = "";

    try {
      const res = await fetch("/email-verification", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ code }),
      });
      const data = await res.json();
      console.log(data);
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
      } else {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.style.color = "#5adaff";
        errorText.textContent = data.data;
        setTimeout(() => {
          errorText.textContent = "";
          errorText.style.color = "red";
        }, 4000);
        location.assign("/user");
      }
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });

  resendEmail.addEventListener("click", async (e) => {
    document.querySelector(".fas.fa-spinner.fa-spin.ti").style.display = "inline-block";

    try {
      const res = await fetch("/send_email", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ code: 1 }),
      });
      const data = await res.json();
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin.ti").style.display = "none";
        errorText2.textContent = data.error;
        setTimeout(() => {
          errorText2.textContent = "";
        }, 4000);
      } else {
        document.querySelector(".fas.fa-spinner.fa-spin.ti").style.display = "none";
        errorText2.style.color = "#5adaff";
        errorText2.textContent = data.data;
        setTimeout(() => {
          errorText2.textContent = "";
          errorText2.style.color = "red";
        }, 4000);
      }
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin.ti").style.display = "none";
      console.log(error);
    }
  });
}

// login
if (loginForm) {
  let errorText = document.querySelector(".auth-error");
  loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const username = e.target.username.value.trim();
    const password = e.target.password.value;

    errorText.textContexnt = "";

    try {
      const res = await fetch("/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
      });
      const data = await res.json();
      console.log(data);
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
      } else {
        if (data.user.is2FA) {
          location.assign("/verify2fa");
        } else {
          location.assign("/user/dashboard");
        }
      }
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });
}

if (verify2FA_form) {
  let errorText = document.querySelector(".auth-error");
  verify2FA_form.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const otp = e.target.otp.value;

    errorText.textContexnt = "";

    try {
      const res = await fetch("/verify2fa", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ otp }),
      });
      const data = await res.json();
      console.log(data);
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
      } else {
        location.assign("/user/dashboard");
      }
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });
}

if (forgotPasswordForm) {
  let errorText = document.querySelector(".auth-error");
  forgotPasswordForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const email = e.target.email.value.trim();
    try {
      const res = await fetch("/forgot-password", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
      });
      const data = await res.json();
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
        return;
      }

      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      errorText.style.color = "green";
      errorText.textContent = data.data;
      setTimeout(() => {
        errorText.textContent = "";
        errorText.style.color = "red";
      }, 4000);
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });
}

if (resetPasswordForm) {
  let errorText = document.querySelector(".auth-error");
  const qs = new URLSearchParams(location.search);
  resetPasswordForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "inline-block";

    const password = e.target.password.value;
    const password1 = e.target.password1.value;

    if (password !== password1) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      errorText.textContent = "Passwords do not match";
      setTimeout(() => {
        errorText.textContent = "";
      }, 4000);
      return;
    }
    try {
      const res = await fetch(`/reset-password?resetToken=${qs.get("resetToken")}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password }),
      });
      const data = await res.json();
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
        return;
      }

      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      errorText.style.color = "green";
      errorText.textContent = "Password changed successfully";
      setTimeout(() => {
        errorText.textContent = "";
        errorText.style.color = "red";
        location.assign("/login");
      }, 4000);
    } catch (error) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      console.log(error);
    }
  });
}

if (editProfileForm) {
  let errorText = document.querySelector(".error_text");

  // let url = location.pathname;
  // let paramsId = url.substring(url.lastIndexOf("/") + 1);

  editProfileForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const phone = e.target.phone.value;
    const btc_btc = e.target.btc_btc.value;
    const eth_erc20 = e.target.eth_erc20.value;
    const usdt_trc20 = e.target.usdt_trc20.value;
    const imagebf = e.target.image.files[0];
    const userId = e.target.userId.value;

    let image;
    if (imagebf) {
      const proof = await convertToBase64(imagebf).catch((err) => console.log(err));
      image = await compressBase64ImageToThumbnail(proof).catch((err) => console.log(err));
    }

    errorText.textContexnt = "";
    errorText.style.color = "red";

    try {
      const res = await fetch(`/user/settings/${userId}`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          phone,
          wallets: {
            btc_btc,
            eth_erc20,
            usdt_trc20,
          },
          image,
        }),
      });
      const data = await res.json();
      if (data.error) {
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 3000);
      } else {
        errorText.style.color = "green";
        errorText.textContent = "Changes were successful";
        setTimeout(() => {
          errorText.textContent = "";
        }, 4000);
        location.reload();
      }
    } catch (error) {
      console.log(error);
    }
  });
}

if (changePassword) {
  let errorText = document.querySelector(".error_text");
  changePassword.addEventListener("submit", async (e) => {
    e.preventDefault();

    const password = e.target.password.value;
    const password1 = e.target.password1.value;
    const password2 = e.target.password2.value;

    console.log(password1, password2);

    if (password1 !== password2) {
      errorText.textContent = "New passwords don't match";
      setTimeout(() => {
        errorText.textContent = "";
      }, 4000);
      return;
    }

    try {
      const res = await fetch(`/user/settings/password`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ password, password1 }),
      });
      const data = await res.json();
      if (data.error) {
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 3000);
        return;
      }

      errorText.style.color = "green";
      errorText.textContent = data.data;
      setTimeout(() => {
        errorText.textContent = "";
        errorText.style.color = "red";
        location.assign("/user/dashboard");
      }, 3000);
    } catch (err) {
      console.log(err);
    }
  });
}

if (auth2FA) {
  let errorText = document.querySelector(".error_text");
  auth2FA.addEventListener("submit", async (e) => {
    e.preventDefault();

    const otp = e.target.otp.value;

    try {
      const res = await fetch(`/user/settings/2fa?type=enable`, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ otp }),
      });
      const data = await res.json();
      if (data.error) {
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 3000);
        return;
      }

      errorText.style.color = "green";
      errorText.textContent = data.data;
      setTimeout(() => {
        errorText.textContent = "";
        errorText.style.color = "red";
        location.reload();
      }, 3000);
    } catch (err) {
      console.log(err);
    }
  });
}
if (disable2FA) {
  let errorText = document.querySelector(".error_text");
  disable2FA.addEventListener("click", async (e) => {
    try {
      const res = await fetch("/user/settings/2fa?type=disable", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ disable: true }),
      });
      const data = await res.json();
      if (data.error) {
        errorText.textContent = data.error;
        setTimeout(() => {
          errorText.textContent = "";
        }, 3000);
        return;
      }

      errorText.style.color = "green";
      errorText.textContent = data.data;
      setTimeout(() => {
        errorText.textContent = "";
        errorText.style.color = "red";
        // location.assign("/user/dashboard");
        location.reload();
      }, 3000);
    } catch (err) {
      console.log(err);
    }
  });
}

if (logoutBtn.length) {
  logoutBtn.forEach((x) => {
    x.addEventListener("click", async (e) => {
      try {
        const res = await fetch("/logout", { method: "GET" });
        const data = await res.json();
        if (data.success) {
          location.assign("/");
        }
      } catch (error) {
        console.log(error);
      }
    });
  });
}

if (planCalcForm) {
  let plans = JSON.parse(plansJSON.textContent);
  planCalcForm.addEventListener("submit", (e) => {
    e.preventDefault();
    let amount = parseFloat(e.target.amount.value);
    let planName = e.target.planName.value;
    plans.forEach((plan, i) => {
      if (planName.trim() === plan.name) {
        if (amount >= parseFloat(plan.amount.min) && amount <= parseFloat(plan.amount.max)) {
          // console.log("here", ((amount / 100) * parseFloat(plan.roi) + amount).toFixed(2));
          e.target.profit.value = ((amount / 100) * parseFloat(plan.roi) + amount).toFixed(2);
        } else {
          e.target.profit.value = "0.00";
        }
      }
    });
  });
}

if (depositForm) {
  const plans = JSON.parse(plansJSON.textContent);
  const user = JSON.parse(userJSON.textContent);
  depositForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const amount = document.querySelector(".deposit-amount").value;
    const plan = e.target.plan.value;
    const method = e.target.method.value;

    if (user.pendingDeposit) {
      document.querySelector(".auth-error").textContent = "You already have a Pending Deposit";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (!plan) {
      document.querySelector(".auth-error").textContent = "Please select an investment plan";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (!amount) {
      document.querySelector(".auth-error").textContent = "Please enter amount to invest";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (amount && plan) {
      const xPlan = plans.find((x) => x.name === plan);
      if (amount < xPlan.amount.min) {
        document.querySelector(".auth-error").textContent = `The min amount for ${plan} is $${xPlan.amount.min}`;
        setTimeout(() => {
          document.querySelector(".auth-error").textContent = "";
        }, 4000);
        return;
      }
      if (amount > xPlan.amount.max) {
        document.querySelector(".auth-error").textContent = `The max amount for ${plan} is $${xPlan.amount.max}`;
        setTimeout(() => {
          document.querySelector(".auth-error").textContent = "";
        }, 4000);
        return;
      }
    }
    if (!method) {
      document.querySelector(".auth-error").textContent = "Please select a payment method";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }

    location.assign(`/user/confirm-deposit?amount=${amount}&plan=${plan}&method=${method}`);
  });
}

if (location.pathname === "/user/preview-deposit") {
  const previewBody = document.querySelector("#con-deposit-details");
  const qrCode = document.querySelector("#qrCode");
  const usdAmount = document.querySelector("#usdAmount");
  const myCoinAmount = document.querySelector("#coinAmount");
  const coinImg = document.querySelector("#coinImg");
  const myWallet = document.querySelector("#wallet");
  const qs = new URLSearchParams(location.search);
  const admin = JSON.parse(adminJSON.textContent);
  const method = qs.get("method").split("_")[0];

  const checkCoin = (coin, data) => {
    if (coin === "BTC") {
      return data.quote.BTC.price.toFixed(6);
    } else if (coin === "ETH") {
      return data.quote.ETH.price.toFixed(6);
    } else if (coin === "LTC") {
      return data.quote.LTC.price.toFixed(6);
    } else if (coin === "BNB") {
      return data.quote.BNB.price.toFixed(6);
    } else if (coin === "BCH") {
      return data.quote.BCH.price.toFixed(6);
    } else if (coin === "DOGE") {
      return data.quote.DOGE.price.toFixed(6);
    } else if (coin === "TRX") {
      return data.quote.TRX.price.toFixed(6);
    } else if (coin === "XRP") {
      return data.quote.XRP.price.toFixed(6);
    } else if (coin === "SHIB") {
      return data.quote.SHIB.price.toFixed(6);
    } else if (coin === "USDT") {
      return data.quote.USDT.price.toFixed(6);
    } else if (coin === "BUSD") {
      return data.quote.BUSD.price.toFixed(6);
    }
  };

  const getWallet = (coin) => {
    if (coin === "BTC_BTC") {
      console.log("here", admin);
      return admin.wallets.btc_btc;
    } else if (coin === "BTC_BEP20") {
      return admin.wallets.btc_bep20;
    } else if (coin === "ETH_ERC20") {
      return admin.wallets.eth_erc20;
    } else if (coin === "ETH_BEP20") {
      return admin.wallets.eth_bep20;
    } else if (coin === "LTC_LTC") {
      return admin.wallets.ltc_ltc;
    } else if (coin === "LTC_BEP20") {
      return admin.wallets.ltc_bep20;
    } else if (coin === "BNB_ERC20") {
      return admin.wallets.bnb_erc20;
    } else if (coin === "BNB_BEP20") {
      return admin.wallets.bnb_bep20;
    } else if (coin === "BCH_BCH") {
      return admin.wallets.bch_bch;
    } else if (coin === "BCH_BEP20") {
      return admin.wallets.bch_bep20;
    } else if (coin === "DOGE_DOGE") {
      return admin.wallets.doge_doge;
    } else if (coin === "DOGE_BEP20") {
      return admin.wallets.doge_bep20;
    } else if (coin === "XRP_BEP20") {
      return admin.wallets.xrp_bep20;
    } else if (coin === "TRX_TRC20") {
      return admin.wallets.trx_trc20;
    } else if (coin === "TRX_BEP20") {
      return admin.wallets.trx_bep20;
    } else if (coin === "BUSD_BEP20") {
      return admin.wallets.busd_bep20;
    } else if (coin === "SHIB_ERC20") {
      return admin.wallets.shib_erc20;
    } else if (coin === "SHIB_BEP20") {
      return admin.wallets.shib_bep20;
    } else if (coin === "USDT_ERC20") {
      return admin.wallets.usdt_erc20;
    } else if (coin === "USDT_TRC20") {
      return admin.wallets.usdt_trc20;
    }
  };

  const convertCrypto = async () => {
    try {
      const res = await fetch("/api/crypto", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          amount: qs.get("amount"),
          coin: method.toUpperCase(),
          myQrCode: getWallet(qs.get("method").toUpperCase()),
        }),
      });

      const data = await res.json();
      if (data.crypto) {
        let coinAmount = checkCoin(method.toUpperCase(), data.crypto);
        let wallet = getWallet(qs.get("method").toUpperCase());
        qrCode.src = data.myQrCode;
        coinImg.src = `/assets/images/gateway/${qs.get("method").toLowerCase()}.png`;
        myWallet.textContent = wallet;
        usdAmount.textContent = `${qs.get("amount")} USD`;
        myCoinAmount.textContent = `${coinAmount} ${method}`;
        let details = `
          <div class="row">
            <div class="col-md-5 text-center">
              <div class="card">
                <div class="card-body">
                  <img src="/assets/images/gateway/${qs
                    .get("method")
                    .toLowerCase()}.png" class="w-10" id="crypto_img" />
                  <p class="text-center mt-2">
                    You have requested <b class="text-success">${qs.get("amount")} USD</b>
                  </p>

                  <div class="divider divider-success">
                    <div class="divider-text">Please pay</div>
                  </div>
                  <h4 id="amount-deposit" class="text-success">${coinAmount} ${method}</h4>
                  <p class="mt-1">To Wallet Address below:</p>
                  <div class="demo-spacing-0">
                    <div class="alert alert-success" role="alert">
                      <div class="alert-body">
                        <h4>${wallet}</h4>
                      </div>
                    </div>
                  </div>
                  <p class="mt-2">for successful deposit</p>
                </div>
              </div>
            </div>
            <div class="col-md-5 text-center">
              <p>Or Scan QR Code to Deposit</p>
              <p class="text-center">
                <img src="${data.myQrCode}" width="243" />
              </p>
              <div class="col-md-12 pb-30">
                <p class="mt-2">After successful transfer. Please upload proof of payment.</p>
              </div>
              <form id="payment-proof-form mt-3" style="width: 100%; display: grid; place-items: center;">
                <style>
                  .deposit-proof {
                    padding: 10px;
                    background: #6d6be77a;
                    border: 2px solid #6d6be7ec;
                    border-radius: 5px;
                    display: grid;
                  }
                  .deposit-proof input {
                    background: #2C5EA6;
                  }
                </style>
                <div class="deposit-proof">
                  <input type="file" accept="image/*" name="proof" />
                </div>
                <p class="auth-error mb-0 mt-2" style="color: red; text-align: center; font-size: 15px;"></p>
                <div class="form-group">
                  <button type="submit" id="pay-con-btn" class="btn btn-success mt-1 text-center me-2">
                    Confirm Payment
                  </button>
                  <a
                    class="btn btn-danger mt-1 text-center"
                    href="/user/deposit"
                    data-dismiss="fileinput"
                  >
                    Cancel
                  </a>
                </div>
              </form>
            </div>
          </div>
        `;

        // previewBody.innerHTML = details;
        // document.querySelector("#crypto-amount").textContent = `${coinAmount} ${qs
        //   .get("method")
        //   .toUpperCase()}`;
        // document.querySelector("#admin-wallet").textContent = wallet;
      }
    } catch (error) {
      console.log(error);
    }
  };
  convertCrypto();

  document.querySelector("#payment-proof-form").addEventListener("submit", async (e) => {
    e.preventDefault();

    document.querySelector(".fas.fa-spinner.fa-spin").style.display = "block";

    const user = JSON.parse(document.querySelector("#user").textContent);
    const userId = user._id;
    const amount = qs.get("amount");
    const method = qs.get("method");
    const proof = await convertToBase64(e.target.proof.files[0]).catch((err) => console.log(err));

    if (!proof) {
      document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
      document.querySelector(".auth-error").textContent = "Please upload proof of payment";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }

    const image = await reduceImageSize(proof).catch((err) => console.log(err));
    const depositType = qs.get("margin") == "true" ? "margin" : "deposit";

    try {
      const res = await fetch(`/user/deposit/${userId}?margin=${qs.get("margin")}`, {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          image,
          amount,
          method,
          type: depositType,
          pending: true,
        }),
      });
      const data = await res.json();
      if (data.error) {
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        document.querySelector(".auth-error").textContent = data.error;
        setTimeout(() => {
          document.querySelector(".auth-error").textContent = "";
        }, 4000);
      } else {
        // document.querySelector(".deposit-info").innerHTML = `
        //   <div style="width: 100%; border: 1px solid #7d77f5; padding: 10px; border-radius: 5px; max-width: 600px; margin: auto;" class="cen-grid mb-2">
        //     <h5>Payment is <span style="color: #7d77f5">Processing</span></h5>
        //     <span class="cen-grid" style="width: 100%; font-size: 18px; color: #7d77f5">
        //       <i class="fas fa-spinner fa-pulse"></i>
        //     </span>
        //     <p class="mt-1">
        //       Your Balance will be updated once Payment is successfully processed.
        //     </p>
        //     <p style="margin-bottom: 10px; color: #7d77f5; font-size: 14px">
        //       Please wait... This may take some time.
        //     </p>
        //   </div>
        // `;
        // location.reload();
        document.querySelector(".fas.fa-spinner.fa-spin").style.display = "none";
        location.assign("/user/transactions");
      }
    } catch (error) {
      console.log(error);
    }
  });
}

if (withdrawForm) {
  withdrawForm.addEventListener("submit", async (e) => {
    e.preventDefault();
    const user = JSON.parse(document.querySelector("#user").textContent);
    const investPlans = JSON.parse(document.querySelector("#investPlans").textContent);
    const amount = parseFloat(e.target.amount.value);
    const method = e.target.method.value;
    let myIdx;
    let myWallet;
    document.querySelector(".auth-error").style.color = "red";

    if (!method) {
      document.querySelector(".auth-error").textContent = "Please select a withdrawal method";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (!amount) {
      document.querySelector(".auth-error").textContent = "Please enter amount";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (amount < 50) {
      document.querySelector(".auth-error").textContent = "Minimum withdrawal amount is $100";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    if (amount > parseFloat(user.balance)) {
      document.querySelector(".auth-error").textContent = "Insufficient fund";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }
    // if (!user.margin || amount > parseFloat(user.margin)) {
    //   document.querySelector(".auth-error").textContent = "Not enough margin";
    //   setTimeout(() => {
    //     document.querySelector(".auth-error").textContent = "";
    //   }, 4000);
    //   return;
    // }
    if (user.balance === 0) {
      document.querySelector(".auth-error").textContent = "Insufficient fund";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }

    if (!user.wallets) {
      document.querySelector(".auth-error").innerHTML = `
        Please provide your <b>${method.split("_")[0].toUpperCase()}</b> wallet!
      `;
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 5000);
      return;
    }

    Object.keys(user.wallets).forEach((wallet, idx) => {
      if (wallet === method) {
        myIdx = idx;
      }
    });

    Object.values(user.wallets).forEach((wallet, idx) => {
      if (myIdx === idx) {
        myWallet = wallet;
      }
    });

    if (!myWallet) {
      document.querySelector(".auth-error").innerHTML = `
        Please provide your <b>${method.split("_")[0].toUpperCase()}</b> wallet
      `;
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 5000);
      return;
    }

    if (user.pendingWithdrawal) {
      document.querySelector(".auth-error").textContent = "You still have a pending withdrawal";
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 4000);
      return;
    }

    // if (user.withdrawalNo < 2 || !user.withdrawalNo) {
    if (user.isKYC) {
      try {
        const res = await fetch(`/user/withdraw/${user._id}`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ amount, method, type: "withdrawal", pending: true }),
        });
        const data = await res.json();
        if (data.error) {
          document.querySelector(".auth-error").textContent = data.error;
          setTimeout(() => {
            document.querySelector(".auth-error").textContent = "";
          }, 4000);
        } else {
          document.querySelector(".auth-error").style.color = "green";
          setTimeout(() => {
            document.querySelector(".auth-error").textContent = "Withdrawal Successful";
          }, 3000);
          location.reload();
        }
      } catch (error) {
        console.log(error);
      }
    } else {
      document.querySelector(".auth-error").innerHTML = `
        Please upload your documents for KYC verification to enable Withdrawal on your account.
      `;
      setTimeout(() => {
        document.querySelector(".auth-error").textContent = "";
      }, 5000);
    }
    // } else {
    //   if (user.lastPlanNo) {
    //     investPlans.forEach(async (plan) => {
    //       if (plan.planNo !== 4 && plan.planNo === user.lastPlanNo + 1) {
    //         document.querySelector(".auth-error").innerHTML = `
    //           Please Upgrade to <b>${plan.name} Package</b> to be eligible for next <b>Withdrawal</b>
    //         `;
    //         setTimeout(() => {
    //           document.querySelector(".auth-error").textContent = "";
    //         }, 5000);
    //       } else if (plan.planNo === 4 && plan.planNo === user.lastPlanNo) {
    //         document.querySelector(".auth-error").innerHTML = `
    //           Please repeat <b>${plan.name} Package</b> Investment to be eligible for next <b>Withdrawal</b>
    //         `;
    //         setTimeout(() => {
    //           document.querySelector(".auth-error").textContent = "";
    //         }, 5000);
    //       }
    //     });
    //   }
    // }
  });
}
