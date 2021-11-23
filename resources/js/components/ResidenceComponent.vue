<template>


    <div class="container" style="padding-bottom: 80px;">

<!--        <loading-->
<!--            :active.sync="isLoading"-->
<!--            :is-full-page="fullPage">-->
<!--        </loading>-->

        <div class="card">
            <div class="card-header">
                <span class="m-0" style="font-size: 18px; font-weight: bold">LGU-Pandi Resident Information System</span>
                <div style="font-size: 14px">HOUSEHOLD PROFILE QUESTIONNAIRE</div>
                <div style="font-size: 14px">MUNICIPALITY OF PANDI, BULACAN</div>

                <button class="btn btn-light mt-2" v-on:click="openModalAddUser">ADD USER</button>
                <button class="btn btn-light mt-2" v-on:click="logout">LOGOUT</button>
            </div>
            <div class="card-body" style="font-size: 14px;">
                <div class="col-12 p-0 mb-2 text-right">
                    <button class="btn btn-success text-right" v-on:click="openReportModal"><i class="far fa-file-pdf mr-2"></i>Export Report</button>
                </div>

                <div class="card">
                    <div class="card-body">
                        <label for="search">Search House Hold</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="House Hold" aria-label="Recipient's username" id="search" v-model="householdinfo">
                            <div class="input-group-append">
                                <button class="btn btn-info" v-on:click="openHouseHoldModal"><i class="fas fa-search"></i></button>
                            </div>
                            <div class="input-group-append">
                                <button class="btn btn-success" v-on:click="addNewHouseHoldModal"><i class="fas fa-plus mr-2"></i> New House Hold</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" v-if="householdhead == null">
                    <div class="card-body">
                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="checkbox" name="head" id="head" value="yes" v-on:change="markAsFamilyHead($event)">
                            <label class="form-check-label" for="head">Mark as head of the family?</label>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Resident Name</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="last_name">Last Name</label>
                                <input type="text" id="last_name" class="form-control" v-model="residence.last_name">
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" id="first_name" class="form-control" v-model="residence.first_name">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" id="middle_name" class="form-control" v-model="residence.middle_name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--        Birthdate            -->



                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Birthdate</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
<!--                                    <label for="month">Month</label>-->
                                    <input type="date" class="form-control" v-model="residence.birthdate">
<!--                                    <select id="month" v-model="residence.birthday_month" class="form-control">-->
<!--                                        <option v-for="month in months">{{ month }}</option>-->
<!--                                    </select>-->
                                </div>
                            </div>
<!--                            <div class="col-4">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="day">Day</label>-->
<!--                                    <select id="day" v-model="residence.birthday_day" class="form-control">-->
<!--                                        <option v-for="day in days">{{ day }}</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="col-4">-->
<!--                                <div class="form-group">-->
<!--                                    <label for="year">Year</label>-->
<!--                                    <input type="number" id="year" class="form-control" maxlength="4" v-model="residence.birthday_year">-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>


                <!--        Birth Place        -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Birth Place</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="town">Town</label>
                                    <input type="text" id="town" class="form-control" v-model="residence.birthplace_town">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="province">Province</label>
                                    <input type="text" id="province" class="form-control" v-model="residence.birthplace_province">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!--      gender              -->



                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Gender</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="sex" id="male" value="male" v-model="residence.gender">
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="sex" id="female" value="female" v-model="residence.gender">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="sex" id="no_value" value="no_value" v-model="residence.gender">
                                        <label class="form-check-label" for="no_value">Prefer not to say.</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="sex" id="other_sex" value="other_sex" v-model="residence.gender">
                                        <label class="form-check-label" for="other_sex">Others</label>
                                    </div>

                                    <input type="text" class="form-control mt-1" placeholder="Other gender" v-model="residence.gender_other" v-if="residence.gender == 'other_sex'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--        marital status            -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Marital Status</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="single" value="single" v-model="residence.martial_status">
                                        <label class="form-check-label" for="single">Single</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="married" value="married" v-model="residence.martial_status">
                                        <label class="form-check-label" for="married">Married</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="widowed" value="widowed" v-model="residence.martial_status">
                                        <label class="form-check-label" for="widowed">Widowed.</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="divorce" value="divorce" v-model="residence.martial_status">
                                        <label class="form-check-label" for="divorce">Divorced/Separated</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="common_law" value="common_law" v-model="residence.martial_status">
                                        <label class="form-check-label" for="common_law">Common Law/Live-in Partner</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="marital" id="other_marital" value="other_marital" v-model="residence.martial_status">
                                        <label class="form-check-label" for="other_marital">Other</label>
                                    </div>

                                    <input type="text" class="form-control mt-1" placeholder="Other Marital Status" v-model="residence.marital_status_other" v-if="residence.martial_status === 'other_marital'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!--         address           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Address</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="house_no">House No.</label>
                                    <input type="text" id="house_no" class="form-control" v-model="residence.house_no">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="street">Street</label>
                                    <input type="text" id="street" class="form-control" v-model="residence.street">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="sitio">Sitio/Purok/Village</label>
                                    <input type="text" id="sitio" class="form-control" v-model="residence.sitio">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="barangay">Barangay</label>
                                    <select id="barangay" v-model="residence.barangay" class="form-control">
                                        <option v-for="data in barangays" v-bind:value="data.id">{{ data.name }}</option>
                                    </select>

<!--                                    <input type="text" id="barangay" class="form-control" v-model="residence.barangay">-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <!--       mobile number         -->



                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Contact Number</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile">Mobile Number</label>
                                    <input type="text" id="mobile" class="form-control" maxlength="12" v-model="residence.mobile">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--         Sectoral Group           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Sectoral Group</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group d-flex justify-content-around">
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="senior" value="senior" v-model="residence.senior">
                                        <label class="form-check-label" for="senior">Senior Citizen</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="disability" value="disability" v-model="residence.disability">
                                        <label class="form-check-label" for="disability">Person With Disability</label>
                                    </div>
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="solo_parent" value="solo_parent" v-model="residence.solo_parent">
                                        <label class="form-check-label" for="solo_parent">Solo Parent.</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="pregnant" value="pregnant" v-model="residence.pregnant">
                                        <label class="form-check-label" for="pregnant">Pregnant</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="lactating_mother" value="lactating_mother" v-model="residence.lactating_mother">
                                        <label class="form-check-label" for="lactating_mother">Lactating Mother</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="checkbox" id="homeless" value="homeless" v-model="residence.homeless">
                                        <label class="form-check-label" for="homeless">Homeless</label>
                                    </div>

<!--                                    <div class="form-check form-check-inline p-2">-->
<!--                                        <input class="form-check-input" type="checkbox" name="sectoral_group" id="none" value="none" v-model="residence.sectoral_group">-->
<!--                                        <label class="form-check-label" for="none">None of the Above</label>-->
<!--                                    </div>-->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--         Nationality           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Nationality</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="nationality" id="filipino" value="filipino" v-model="residence.nationality">
                                        <label class="form-check-label" for="filipino">Filipino</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="nationality" id="other_nationality" value="other_nationality" v-model="residence.nationality">
                                        <label class="form-check-label" for="other_nationality">Other Nationality</label>
                                    </div>

                                    <label for="other_nationality"></label>
                                    <input type="text" class="form-control" placeholder="Other Nationality" v-model="residence.nationality_other" v-if="residence.nationality === 'other_nationality'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--         Employee           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Employed?</b>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="employed" id="employed_yes" value="employed_yes" v-model="residence.employed">
                                        <label class="form-check-label" for="employed_yes">Yes, Indicate Employer Name</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="employed" id="employed_no" value="employed_no" v-model="residence.employed">
                                        <label class="form-check-label" for="employed_no">No, Unemployed since</label>
                                    </div>

                                    <div class="form-check form-check-inline p-2">
                                        <input class="form-check-input" type="radio" name="employed" id="self_employed" value="self_employed" v-model="residence.employed">
                                        <label class="form-check-label" for="self_employed">No, Self-employed</label>
                                    </div>

                                    <label for="other_nationality"></label>
                                    <input type="text" id="other_nationality" class="form-control" v-model="residence.employed_other" v-if="residence.employed === 'employed_no' || residence.employed === 'employed_yes'">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!--         Employed           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Engaged in Business?</b>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" type="radio" name="business" id="business_owner" value="business_owner" v-model="residence.business_type">
                                    <label class="form-check-label" for="business_owner">Yes, Business Owner</label>
                                </div>

                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" type="radio" name="business" id="business_co_owner" value="business_co_owner" v-model="residence.business_type">
                                    <label class="form-check-label" for="business_co_owner">Yes, Business co-owner/partner</label>
                                </div>

                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" type="radio" name="business" id="investor" value="investor" v-model="residence.business_type">
                                    <label class="form-check-label" for="investor">Yes, Investor</label>
                                </div>

                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" type="radio" name="business" id="business_other" value="business_other" v-model="residence.business_type">
                                    <label class="form-check-label" for="business_other">Yes, other:</label>
                                </div>

                                <div class="form-check form-check-inline p-2">
                                    <input class="form-check-input" type="radio" name="business" id="business_no" value="business_no" v-model="residence.business_type">
                                    <label class="form-check-label" for="business_no">No</label>
                                </div>

                                <div class="form-group" v-if="residence.business_type === 'business_owner' || residence.business_type === 'business_co_owner' || residence.business_type === 'business_other'">
                                    <input type="text" class="form-control mt-2 mb-2" placeholder="Business Name" v-model="residence.business_name_other">
                                    <input type="text" class="form-control" placeholder="Business Type" v-model="residence.business_type_other">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!--         Registered voter           -->


                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Registered Voter in Pandi? Bulacan?</b>
                    </div>
                    <div class="card-body">

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="voter" id="voter_yes" value="yes" v-model="residence.voter">
                            <label class="form-check-label" for="voter_yes">Yes.</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="voter" id="voter_no" value="no" v-model="residence.voter">
                            <label class="form-check-label" for="voter_no">No, registered in:</label>
                        </div>

                        <input type="text" class="form-control mt-2 mb-2" placeholder="Registered In" v-model="residence.voter_other" v-if="residence.voter === 'no'">
                    </div>
                </div>



                <!--        Religious Affiliation            -->



                <div class="card">
                    <div class="card-header">
                        <b style="color: #636e72">Religious Affiliation</b>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="catholic" value="catholic" v-model="residence.religion">
                            <label class="form-check-label" for="catholic">Catholic</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="born_again" value="born_again" v-model="residence.religion">
                            <label class="form-check-label" for="born_again">Born Again Christian</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="baptist" value="baptist" v-model="residence.religion">
                            <label class="form-check-label" for="baptist">Baptist</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="inc" value="inc" v-model="residence.religion">
                            <label class="form-check-label" for="inc">Iglesia ni Cristo</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="jehova" value="jehova" v-model="residence.religion">
                            <label class="form-check-label" for="jehova">Jehova's Witness</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="adventist" value="adventist" v-model="residence.religion">
                            <label class="form-check-label" for="adventist">7th Day Adventist</label>
                        </div>

                        <div class="form-check form-check-inline p-2">
                            <input class="form-check-input" type="radio" name="religion" id="other_religion" value="other_religion" v-model="residence.religion">
                            <label class="form-check-label" for="adventist">Other</label>
                        </div>

                        <input type="text" class="form-control mt-2 mb-2" placeholder="Other Religion" v-model="residence.religion_other" v-if="residence.religion === 'other_religion'">
                    </div>
                </div>


                <div class="form-group text-right">
                    <button class="btn btn-success" v-on:click="saveResidence"><i class="fas fa-plus mr-2"></i> Add Residence</button>
                </div>
            </div>
        </div>



        <div class="modal" tabindex="-1" role="dialog" id="houseHoldModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h5 v-if="report" class="modal-title">Generate Report</h5>
                        <h5 v-if="newHouseHold" class="modal-title">House Hold</h5>
                        <h5 v-if="addUser" class="modal-title">Add user</h5>


                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" v-if="searchHouseHold">
                            <v-client-table style="font-size: 15px"
                                            :data="household"
                                            :columns="columns"
                                            :options="options">
                                    <span slot="action" slot-scope="{row}">
                                        <button
                                            v-on:click="selectHouseHold(row.id)"
                                            class="btn btn-primary mb-2 form-control"
                                            style="font-size: 12px">
                                            Select
                                        </button>
                                    </span>
                            </v-client-table>
                        </div>

                        <div class="form-group" v-if="newHouseHold">
                            <label>House No</label>
                            <input type="text" class="form-control" v-model="household.house_no">

                            <label>Street</label>
                            <input type="text" class="form-control" v-model="household.street">

                            <label>Sitio</label>
                            <input type="text" class="form-control" v-model="household.sitio">

                            <label>Barangay</label>
                            <select id="barangay" v-model="household.barangay" class="form-control">
                                <option v-for="data in barangays" v-bind:value="data.id">{{ data.name }}</option>
                            </select>
                        </div>

                        <div class="form-group" v-if="report">
                            <select class="form-control" v-model="report_type">
                                <option value="per_barangay">Voter's count Per Barangay</option>
                                <option value="house_holds">Voter's House Holds</option>
                            </select>
                        </div>

                        <div class="form-group" v-if="addUser">
                            <label for="username">Username</label>
                            <input v-model = "user.name" type="text" class="form-control" id="username">

                            <label for="email">Email Address</label>
                            <input v-model = "user.email" type="email" class="form-control" id="email">

                            <label for="userpass">Password</label>
                            <input v-model = "user.password" type="password" class="form-control" id="userpass">
                        </div>



                    </div>
                    <div class="modal-footer">
                        <div v-if="newHouseHold">
                            <button type="button" class="btn btn-primary" v-on:click="saveHouseHold">Save data</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        <div v-if="report">
                            <button type="button" class="btn btn-primary" v-on:click="generateReport">Print Report</button>
                        </div>
                        <div v-if="addUser">
                            <button type="button" class="btn btn-primary" v-on:click="saveUser">Save user</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>


</template>

<script>

// // Import component
// import Loading from 'vue-loading-overlay';
import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'vue-loading-overlay/dist/vue-loading.css';
import 'sweetalert2/src/sweetalert2.scss';

export default {
    data() {
        return {

            columns: ['house_no', 'street', 'sitio', 'barangay', 'head_family', 'action'],
            options: {
                headings: {
                    house_no: 'House #',
                    street: 'Street',
                    sitio: 'Sitio',
                    barangay: 'Barangay',
                    head_family: 'Head',
                    action: 'Action',
                },
                filterable: ['house_no', 'street', 'sitio', 'barangay', 'head_family'],
                sortable: ['house_no', 'street', 'sitio', 'barangay', 'head_family'],
                texts : {
                    filter: 'Search House Hold:',
                },
            },

            report_type: '',
            householdid: '',
            householdhead: '',
            householdinfo: '',
            household: [],
            residence: [],
            barangays: [],
            user: [],
            addUser: true,
            asFamilyHead: false,
            isLoading: false,
            newHouseHold: false,
            searchHouseHold: false,
            report: false,
            fullPage: true,
            months: ['JANUARY', 'FEBRUARY', 'MARCH', 'APRIL', 'MAY', 'JUNE', 'JULY', 'AUGUST', 'SEPTEMBER', 'OCTOBER', 'NOVEMBER', 'DECEMBER'],
            days: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16','17', '18', '19', '20',
                    '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
        }
    },

    // components: {
    //     Loading
    // },

    methods: {

        messageBox(type, title, text, button) {
            Swal.fire({
                type: type,
                title: title,
                text: text,
                confirmButtonText: button
            }).then();
        },

        initialData() {
            axios.get('residence/initial')
            .then(response => {
                this.barangays = response.data.barangays;
            });

            axios.get('household/getdata')
            .then(response => {
                this.household = response.data.house_holds;
            });
        },

        saveResidence() {

            if(this.householdinfo === '')
            {
                this.messageBox('error', 'Invalid House hold', 'No selected house hold!', 'Okay');
                return;
            }

            if(this.residence.last_name == null || this.residence.first_name == null || this.residence.last_name === '' || this.residence.first_name === '') {
                this.messageBox('error', 'Input Required', 'Name is Required!', 'Okay');
                return;
            }

            if(this.residence.birthday_month == null || this.residence.birthday_day == null || this.residence.birthday_year === '' || this.residence.birthday_month === '' || this.residence.birthday_day === '' || this.residence.birthday_year === '') {
                this.messageBox('error', 'Input Required', 'Birthday is Required!', 'Okay');
                return;
            }

            if(this.residence.birthplace_town == null || this.residence.birthplace_province == null || this.residence.birthplace_town === '' || this.residence.birthplace_province === '') {
                this.messageBox('error', 'Input Required', 'Birthplace is Required', 'Okay');
                return;
            }

            if(this.residence.house_no == null || this.residence.street == null || this.residence.sitio == null || this.residence.barangay == null || this.residence.house_no === '' || this.residence.street === '' || this.residence.sitio === '' || this.residence.barangay === '') {
                this.messageBox('error', 'Input Required', 'Address is Required', 'Okay');
                return;
            }

            if(this.residence.gender == null || this.residence.gender === '') {
                this.messageBox('error', 'Input Required', 'Gender is Required', 'Okay');
                return;
            }

            if(this.residence.martial_status == null || this.residence.martial_status === '') {
                this.messageBox('error', 'Input Required', 'Martial Status is Required', 'Okay');
                return;
            }

            // if(this.residence.sectoral_group == null || this.residence.sectoral_group === '') {
            //     this.messageBox('error', 'Input Required', 'Sectoral Group is Required', 'Okay');
            //     return;
            // }

            if(this.residence.nationality == null || this.residence.nationality === '') {
                this.messageBox('error', 'Input Required', 'Nationality is Required', 'Okay');
                return;
            }

            if(this.residence.mobile == null || this.residence.mobile === '') {
                this.messageBox('error', 'Input Required', 'Mobile is Required', 'Okay');
                return;
            }

            if(this.residence.employed == null || this.residence.employed === '') {
                this.messageBox('error', 'Input Required', 'Employed is Required', 'Okay');
                return;
            }

            if(this.residence.business_type == null || this.residence.business_type === '') {
                this.messageBox('error', 'Input Required', 'Business Engagement is Required', 'Okay');
                return;
            }

            if(this.residence.voter == null || this.residence.voter === '') {
                this.messageBox('error', 'Input Required', 'Voter is Required', 'Okay');
                return;
            }

            if(this.residence.religion == null || this.residence.religion === '') {
                this.messageBox('error', 'Input Required', 'Religion is Required', 'Okay');
                return;
            }



            axios.post('residence/store', {
                last_name                   : this.residence.last_name,
                first_name                  : this.residence.first_name,
                middle_name                 : this.residence.middle_name,
                birthdate                   : this.residence.birthdate,
                birthplace_town             : this.residence.birthplace_town,
                birthplace_province         : this.residence.birthplace_province,
                gender                      : this.residence.gender,
                gender_other                : this.residence.gender_other,
                martial_status              : this.residence.martial_status,
                marital_status_other        : this.residence.marital_status_other,
                house_no                    : this.residence.house_no,
                street                      : this.residence.street,
                sitio                       : this.residence.sitio,
                barangay                    : this.residence.barangay,
                mobile                      : this.residence.mobile,
                sectoral_group              : 'none',
                senior                      : this.residence.senior == null ? false : this.residence.senior,
                disability                  : this.residence.disability == null ? false : this.residence.disability,
                solo_parent                 : this.residence.solo_parent == null ? false : this.residence.solo_parent,
                pregnant                    : this.residence.pregnant == null ? false : this.residence.pregnant,
                lactating_mother            : this.residence.lactating_mother == null ? false : this.residence.lactating_mother,
                homeless                    : this.residence.homeless == null ? false : this.residence.homeless,
                nationality                 : this.residence.nationality,
                nationality_other           : this.residence.nationality_other,
                employed                    : this.residence.employed,
                employed_other              : this.residence.employed_other,
                business_type               : this.residence.business_type,
                business_name_other         : this.residence.business_name_other,
                business_type_other         : this.residence.business_type_other,
                voter                       : this.residence.voter,
                voter_other                 : this.residence.voter_other,
                religion                    : this.residence.religion,
                religion_other              : this.residence.religion_other,
                household                   : this.householdid,
                as_head_family              : this.asFamilyHead,
            }).then(response => {
                if(response.status === 200)
                {
                    this.messageBox('success', 'Save Successfully', 'Residence Successfully Saved!', 'Okay');
                    setTimeout(function(){ location.reload() }, 2000);
                }
            }).catch(errors => {

                const message =  errors.response.data.errors;
                this.messageBox('error', 'Failed to save', message, 'Okay');
            })
        },

        openHouseHoldModal() {
            $('#houseHoldModal').modal('show');
            this.newHouseHold = false;
            this.searchHouseHold = true;
            this.report = false;
            this.addUser = false;
        },

        addNewHouseHoldModal() {
            $('#houseHoldModal').modal('show');
            this.newHouseHold = true;
            this.searchHouseHold = false;
            this.report = false;
            this.addUser = false;
        },

        openReportModal() {
            $('#houseHoldModal').modal('show');
            this.newHouseHold = false;
            this.searchHouseHold = false;
            this.report = true;
            this.addUser = false;
        },

        selectHouseHold(id) {
            this.household.forEach((item) => {
                if(item.id === id)
                {
                    console.log(item);
                    this.householdinfo = item.house_no + ' ' + item.street + ' ' + item.sitio + ' ' + item.barangay;
                    this.householdid = item.id;
                    this.householdhead = item.head_family;
                }
            });

            $('#houseHoldModal').modal('hide');
        },

        markAsFamilyHead(e) {

            this.asFamilyHead = false;

            if(e.target.checked)
            {
                this.asFamilyHead = true;
                return
            }
        },

        saveHouseHold() {

            axios.post('household/store', {
                house_no: this.household.house_no,
                street: this.household.street,
                sitio: this.household.sitio,
                barangay: this.household.barangay,
            }).then(response => {
                if(response.status === 200)
                {
                    this.messageBox('success', 'Save Successfully', 'House Hold Successfully Saved!', 'Okay');
                }
            })
        },

        generateReport() {
            console.log(this.report_type);
            if(this.report_type === 'per_barangay') {
                window.open('residence/voters_pdf');
            }
            else
            {
                window.open('household/household_pdf');
            }
        },

        logout() {
            window.location.href = 'logout';
        },

        openModalAddUser() {
            $('#houseHoldModal').modal('show');
            this.newHouseHold = false;
            this.searchHouseHold = false;
            this.report = false;
            this.addUser = true;
        },

        saveUser() {
            axios.post('users/store',
            {
                name: this.user.name,
                email: this.user.email,
                password: this.user.password,
            }).then(response => {
                if(response.status === 200)
                {
                    this.messageBox('success', 'Save Successfully', 'Residence Successfully Saved!', 'Okay');
                    setTimeout(function(){ location.reload() }, 2000);
                }
            }).catch(errors => {

                const message =  errors.response.data.errors;
                this.messageBox('error', 'Failed to save', message, 'Okay');
            })
        }

    },

    mounted() {
        // this.residence.family_head = false;
        this.initialData();
    }

}
</script>

<style scoped>
    label {
        color: #636e72;
    }

    input, button {
        font-size: 14px;
    }
</style>
