@extends('layout.default')
@section('title')
User Register
    
@endsection
@section('content')
  <main class="main" id="top">
    <div class="container" data-layout="container">

      {{-- ✅ Handle fluid layout --}}
      <script>
        document.addEventListener("DOMContentLoaded", function () {
          const isFluid = JSON.parse(localStorage.getItem('isFluid'));
          if (isFluid) {
            const container = document.querySelector('[data-layout]');
            container.classList.remove('container');
            container.classList.add('container-fluid');
          }
        });
      </script>

      <div class="row flex-center min-vh-100 py-6">
        <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">

          {{-- ✅ Logo --}}
          <a class="d-flex flex-center mb-4" href="{{ url('/') }}">
       <img class="me-2" 
    src="{{ $settings && $settings->logo_dark ? asset('public/storage/' . $settings->logo_dark) : asset('assets/img/default-logo.png') }}" 
     alt="Logo" 
     width="200">

            {{-- <span class="font-sans-serif text-primary fw-bolder fs-4 d-inline-block">falcon</span> --}}
          </a>

          <div class="card">
            <div class="card-body p-4 p-sm-5">

              <div class="row flex-between-center mb-2">
                <div class="col-auto">
                  <h5>Register</h5>
                </div>
                <div class="col-auto fs-10 text-600">
                  <span>or</span> <a href="{{ route('user.login') }}">Login</a>
                </div>
              </div>

              <form method="POST" action="{{ route('user.register') }}">
                @csrf

                {{-- ✅ Fullname & Username --}}
                <div class="row gx-3">
                  <div class="col-md-6 mb-3">
                    <input class="form-control" type="text" name="fullname" placeholder="Full Name"
                      value="{{ old('fullname') }}" required>
                    @error('fullname') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  <div class="col-md-6 mb-3">
                    <input class="form-control" type="text" name="username" placeholder="Username"
                      value="{{ old('username') }}" required>
                    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                </div>

                {{-- ✅ Email --}}
                <div class="mb-3">
                  <input class="form-control" type="email" name="email" placeholder="Email Address"
                    value="{{ old('email') }}" required>
                  @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                {{-- ✅ Country & Country Code --}}
                <div class="row gx-3">
                  <div class="col-md-8 mb-3">
                    <select class="form-select" name="country" id="country" required>
                      <option value="">🌍 Select your country...</option>

                      <option value="Afghanistan" data-code="+93">🇦🇫 Afghanistan</option>
                      <option value="Albania" data-code="+355">🇦🇱 Albania</option>
                      <option value="Algeria" data-code="+213">🇩🇿 Algeria</option>
                      <option value="Andorra" data-code="+376">🇦🇩 Andorra</option>
                      <option value="Angola" data-code="+244">🇦🇴 Angola</option>
                      <option value="Argentina" data-code="+54">🇦🇷 Argentina</option>
                      <option value="Armenia" data-code="+374">🇦🇲 Armenia</option>
                      <option value="Australia" data-code="+61">🇦🇺 Australia</option>
                      <option value="Austria" data-code="+43">🇦🇹 Austria</option>
                      <option value="Azerbaijan" data-code="+994">🇦🇿 Azerbaijan</option>
                      <option value="Bahamas" data-code="+1-242">🇧🇸 Bahamas</option>
                      <option value="Bahrain" data-code="+973">🇧🇭 Bahrain</option>
                      <option value="Bangladesh" data-code="+880">🇧🇩 Bangladesh</option>
                      <option value="Barbados" data-code="+1-246">🇧🇧 Barbados</option>
                      <option value="Belarus" data-code="+375">🇧🇾 Belarus</option>
                      <option value="Belgium" data-code="+32">🇧🇪 Belgium</option>
                      <option value="Belize" data-code="+501">🇧🇿 Belize</option>
                      <option value="Benin" data-code="+229">🇧🇯 Benin</option>
                      <option value="Bhutan" data-code="+975">🇧🇹 Bhutan</option>
                      <option value="Bolivia" data-code="+591">🇧🇴 Bolivia</option>
                      <option value="Bosnia and Herzegovina" data-code="+387">🇧🇦 Bosnia and Herzegovina</option>
                      <option value="Botswana" data-code="+267">🇧🇼 Botswana</option>
                      <option value="Brazil" data-code="+55">🇧🇷 Brazil</option>
                      <option value="Brunei" data-code="+673">🇧🇳 Brunei</option>
                      <option value="Bulgaria" data-code="+359">🇧🇬 Bulgaria</option>
                      <option value="Burkina Faso" data-code="+226">🇧🇫 Burkina Faso</option>
                      <option value="Burundi" data-code="+257">🇧🇮 Burundi</option>
                      <option value="Cambodia" data-code="+855">🇰🇭 Cambodia</option>
                      <option value="Cameroon" data-code="+237">🇨🇲 Cameroon</option>
                      <option value="Canada" data-code="+1">🇨🇦 Canada</option>
                      <option value="Chad" data-code="+235">🇹🇩 Chad</option>
                      <option value="Chile" data-code="+56">🇨🇱 Chile</option>
                      <option value="China" data-code="+86">🇨🇳 China</option>
                      <option value="Colombia" data-code="+57">🇨🇴 Colombia</option>
                      <option value="Congo" data-code="+242">🇨🇬 Congo</option>
                      <option value="Costa Rica" data-code="+506">🇨🇷 Costa Rica</option>
                      <option value="Croatia" data-code="+385">🇭🇷 Croatia</option>
                      <option value="Cuba" data-code="+53">🇨🇺 Cuba</option>
                      <option value="Cyprus" data-code="+357">🇨🇾 Cyprus</option>
                      <option value="Czech Republic" data-code="+420">🇨🇿 Czech Republic</option>
                      <option value="Denmark" data-code="+45">🇩🇰 Denmark</option>
                      <option value="Dominican Republic" data-code="+1-809">🇩🇴 Dominican Republic</option>
                      <option value="DR Congo" data-code="+243">🇨🇩 DR Congo</option>
                      <option value="Ecuador" data-code="+593">🇪🇨 Ecuador</option>
                      <option value="Egypt" data-code="+20">🇪🇬 Egypt</option>
                      <option value="Estonia" data-code="+372">🇪🇪 Estonia</option>
                      <option value="Ethiopia" data-code="+251">🇪🇹 Ethiopia</option>
                      <option value="Finland" data-code="+358">🇫🇮 Finland</option>
                      <option value="France" data-code="+33">🇫🇷 France</option>
                      <option value="Gabon" data-code="+241">🇬🇦 Gabon</option>
                      <option value="Gambia" data-code="+220">🇬🇲 Gambia</option>
                      <option value="Georgia" data-code="+995">🇬🇪 Georgia</option>
                      <option value="Germany" data-code="+49">🇩🇪 Germany</option>
                      <option value="Ghana" data-code="+233">🇬🇭 Ghana</option>
                      <option value="Greece" data-code="+30">🇬🇷 Greece</option>
                      <option value="Grenada" data-code="+1-473">🇬🇩 Grenada</option>
                      <option value="Guinea" data-code="+224">🇬🇳 Guinea</option>
                      <option value="Hong Kong" data-code="+852">🇭🇰 Hong Kong</option>
                      <option value="Hungary" data-code="+36">🇭🇺 Hungary</option>
                      <option value="Iceland" data-code="+354">🇮🇸 Iceland</option>
                      <option value="India" data-code="+91">🇮🇳 India</option>
                      <option value="Indonesia" data-code="+62">🇮🇩 Indonesia</option>
                      <option value="Iran" data-code="+98">🇮🇷 Iran</option>
                      <option value="Iraq" data-code="+964">🇮🇶 Iraq</option>
                      <option value="Ireland" data-code="+353">🇮🇪 Ireland</option>
                      <option value="Israel" data-code="+972">🇮🇱 Israel</option>
                      <option value="Italy" data-code="+39">🇮🇹 Italy</option>
                      <option value="Jamaica" data-code="+1-876">🇯🇲 Jamaica</option>
                      <option value="Japan" data-code="+81">🇯🇵 Japan</option>
                      <option value="Jordan" data-code="+962">🇯🇴 Jordan</option>
                      <option value="Kenya" data-code="+254">🇰🇪 Kenya</option>
                      <option value="Kuwait" data-code="+965">🇰🇼 Kuwait</option>
                      <option value="Latvia" data-code="+371">🇱🇻 Latvia</option>
                      <option value="Lebanon" data-code="+961">🇱🇧 Lebanon</option>
                      <option value="Lesotho" data-code="+266">🇱🇸 Lesotho</option>
                      <option value="Liberia" data-code="+231">🇱🇷 Liberia</option>
                      <option value="Libya" data-code="+218">🇱🇾 Libya</option>
                      <option value="Lithuania" data-code="+370">🇱🇹 Lithuania</option>
                      <option value="Luxembourg" data-code="+352">🇱🇺 Luxembourg</option>
                      <option value="Madagascar" data-code="+261">🇲🇬 Madagascar</option>
                      <option value="Malawi" data-code="+265">🇲🇼 Malawi</option>
                      <option value="Malaysia" data-code="+60">🇲🇾 Malaysia</option>
                      <option value="Maldives" data-code="+960">🇲🇻 Maldives</option>
                      <option value="Mali" data-code="+223">🇲🇱 Mali</option>
                      <option value="Malta" data-code="+356">🇲🇹 Malta</option>
                      <option value="Mauritius" data-code="+230">🇲🇺 Mauritius</option>
                      <option value="Mexico" data-code="+52">🇲🇽 Mexico</option>
                      <option value="Moldova" data-code="+373">🇲🇩 Moldova</option>
                      <option value="Monaco" data-code="+377">🇲🇨 Monaco</option>
                      <option value="Mongolia" data-code="+976">🇲🇳 Mongolia</option>
                      <option value="Montenegro" data-code="+382">🇲🇪 Montenegro</option>
                      <option value="Morocco" data-code="+212">🇲🇦 Morocco</option>
                      <option value="Mozambique" data-code="+258">🇲🇿 Mozambique</option>
                      <option value="Namibia" data-code="+264">🇳🇦 Namibia</option>
                      <option value="Nepal" data-code="+977">🇳🇵 Nepal</option>
                      <option value="Netherlands" data-code="+31">🇳🇱 Netherlands</option>
                      <option value="New Zealand" data-code="+64">🇳🇿 New Zealand</option>
                      <option value="Niger" data-code="+227">🇳🇪 Niger</option>
                      <option value="Nigeria" data-code="+234">🇳🇬 Nigeria</option>
                      <option value="Norway" data-code="+47">🇳🇴 Norway</option>
                      <option value="Oman" data-code="+968">🇴🇲 Oman</option>
                      <option value="Pakistan" data-code="+92">🇵🇰 Pakistan</option>
                      <option value="Palestine" data-code="+970">🇵🇸 Palestine</option>
                      <option value="Panama" data-code="+507">🇵🇦 Panama</option>
                      <option value="Paraguay" data-code="+595">🇵🇾 Paraguay</option>
                      <option value="Peru" data-code="+51">🇵🇪 Peru</option>
                      <option value="Philippines" data-code="+63">🇵🇭 Philippines</option>
                      <option value="Poland" data-code="+48">🇵🇱 Poland</option>
                      <option value="Portugal" data-code="+351">🇵🇹 Portugal</option>
                      <option value="Qatar" data-code="+974">🇶🇦 Qatar</option>
                      <option value="Romania" data-code="+40">🇷🇴 Romania</option>
                      <option value="Russia" data-code="+7">🇷🇺 Russia</option>
                      <option value="Rwanda" data-code="+250">🇷🇼 Rwanda</option>
                      <option value="Saudi Arabia" data-code="+966">🇸🇦 Saudi Arabia</option>
                      <option value="Senegal" data-code="+221">🇸🇳 Senegal</option>
                      <option value="Seychelles" data-code="+248">🇸🇨 Seychelles</option>
                      <option value="Sierra Leone" data-code="+232">🇸🇱 Sierra Leone</option>
                      <option value="Singapore" data-code="+65">🇸🇬 Singapore</option>
                      <option value="Slovakia" data-code="+421">🇸🇰 Slovakia</option>
                      <option value="Slovenia" data-code="+386">🇸🇮 Slovenia</option>
                      <option value="South Africa" data-code="+27">🇿🇦 South Africa</option>
                      <option value="South Korea" data-code="+82">🇰🇷 South Korea</option>
                      <option value="Spain" data-code="+34">🇪🇸 Spain</option>
                      <option value="Sri Lanka" data-code="+94">🇱🇰 Sri Lanka</option>
                      <option value="Sudan" data-code="+249">🇸🇩 Sudan</option>
                      <option value="Sweden" data-code="+46">🇸🇪 Sweden</option>
                      <option value="Switzerland" data-code="+41">🇨🇭 Switzerland</option>
                      <option value="Syria" data-code="+963">🇸🇾 Syria</option>
                      <option value="Taiwan" data-code="+886">🇹🇼 Taiwan</option>
                      <option value="Tanzania" data-code="+255">🇹🇿 Tanzania</option>
                      <option value="Thailand" data-code="+66">🇹🇭 Thailand</option>
                      <option value="Togo" data-code="+228">🇹🇬 Togo</option>
                      <option value="Trinidad and Tobago" data-code="+1-868">🇹🇹 Trinidad and Tobago</option>
                      <option value="Tunisia" data-code="+216">🇹🇳 Tunisia</option>
                      <option value="Turkey" data-code="+90">🇹🇷 Turkey</option>
                      <option value="Uganda" data-code="+256">🇺🇬 Uganda</option>
                      <option value="Ukraine" data-code="+380">🇺🇦 Ukraine</option>
                      <option value="United Arab Emirates" data-code="+971">🇦🇪 UAE</option>
                      <option value="United Kingdom" data-code="+44">🇬🇧 United Kingdom</option>
                      <option value="United States" data-code="+1">🇺🇸 United States</option>
                      <option value="Uruguay" data-code="+598">🇺🇾 Uruguay</option>
                      <option value="Uzbekistan" data-code="+998">🇺🇿 Uzbekistan</option>
                      <option value="Venezuela" data-code="+58">🇻🇪 Venezuela</option>
                      <option value="Vietnam" data-code="+84">🇻🇳 Vietnam</option>
                      <option value="Yemen" data-code="+967">🇾🇪 Yemen</option>
                      <option value="Zambia" data-code="+260">🇿🇲 Zambia</option>
                      <option value="Zimbabwe" data-code="+263">🇿🇼 Zimbabwe</option>
                    </select>
                    @error('country') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  <div class="col-md-4 mb-3">
                    <input class="form-control" type="text" name="country_code" id="country_code" placeholder="+234"
                      value="{{ old('country_code') }}" required>
                    @error('country_code') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>
                </div>


                {{-- ✅ Phone --}}
                <div class="mb-3">
                  <input class="form-control" type="tel" name="phone" placeholder="Phone Number"
                    value="{{ old('phone') }}" required>
                  @error('phone') <small class="text-danger">{{ $message }}</small> @enderror

                       {{-- ✅ Referral Field (Auto-filled & Readonly) --}}
              @if(session()->has('referrer'))
                <div class="mb-3">
                  <label class="form-label">Referred by</label>
                  <input class="form-control" type="text" name="referrer" value="{{ session('referrer') }}" readonly>
                </div>
              @endif

                  {{-- ✅ Password & Confirm Password with show/hide --}}
                  <div class="row gx-3 mt-3">
                    <div class="col-md-6 mb-3 position-relative">
                      <input class="form-control" type="password" name="password" id="password" placeholder="Password"
                        required>
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;"
                        onclick="togglePassword('password', this)">👁️</span>
                      @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3 position-relative">
                      <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                        placeholder="Confirm Password" required>
                      <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;"
                        onclick="togglePassword('password_confirmation', this)">👁️</span>
                    </div>
                  </div>
                  {{-- ✅ Submit --}}
                  <div class="mb-3">
                    <button class="btn btn-primary d-block w-100 mt-3" type="submit">Sign up</button>
                  </div>
              </form>

            </div>
          </div>

        </div>
      </div>
    </div>
  </main>

  {{-- ✅ Auto-fill country code --}}
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const countrySelect = document.getElementById("country");
      const codeInput = document.getElementById("country_code");

      if (countrySelect && codeInput) {
        countrySelect.addEventListener("change", function () {
          const selected = this.options[this.selectedIndex];
          const code = selected.getAttribute("data-code");
          if (code) codeInput.value = code;
        });
      }
    });
    function togglePassword(fieldId, el) {
      const input = document.getElementById(fieldId);
      if (input.type === "password") {
        input.type = "text";
        el.textContent = "🙈"; // icon change
      } else {
        input.type = "password";
        el.textContent = "👁️";
      }
    }
  </script>

@endsection