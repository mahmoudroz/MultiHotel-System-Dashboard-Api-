<?php

namespace App\Http\Controllers\Api\Supervisor;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCustomResource;
use App\Http\Resources\EmployeeCustomResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\OrderResource;
use App\Models\Category;
use App\Models\Employee;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Models\Order;
use App\Models\Resemployee;
use App\Models\Room;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\NotificationTrait;
use App\Models\Hotel;

class OrderController extends Controller
{
    use NotificationTrait;
    public function getAuthCategory()
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $categories=Category::whereIn('id',$supervisor->res()->pluck('category_id'))->get();
        return response()->json([
            'status'  => true,
            'categories'     =>CategoryCustomResource::collection($categories),
        ], 200);
    }
    public function getMyEmployee()
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $employees=Employee::where('supervisor_id',$supervisor->id)->paginate(8);
        if($employees->count() < 0 )
        {
            return response()->json([
                'status'  => false,
                'message' => __('site.no_records'),
            ], 404);
        }
        return response()->json([
            'status'  => true,
            'categories'     =>EmployeeResource::collection($employees),
        ], 200);
    }
    public function getOrders(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'category_id'=>'nullable|exists:categories,id',
            'date'=>'nullable | date_format:Y-m-d',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $new=Order::with(['guest','employee','supervisor','payment','room','orderdetails'=>function($q){
            $q->with('service');
        }])->where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)->where('status','new')
        ->when($request->date,function($q) use($request){
            $q->whereDate('created_at',$request->date);
        });

        $process=Order::with(['guest','employee','supervisor','payment','room','orderdetails'=>function($q){
            $q->with('service');
        }])->where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)->where('status','process')
        ->when($request->date,function($q) use($request){
            $q->whereDate('created_at',$request->date);
        });

        $end=Order::with(['guest','employee','supervisor','payment','room','orderdetails'=>function($q){
            $q->with('service');
        }])->where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)->where('status','end')
        ->when($request->date,function($q) use($request){
            $q->whereDate('created_at',$request->date);
        });

        if($request->category_id != null)
        {
            $serIDS=Service::whereIn('unit_id',Category::find($request->category_id)->unit()->pluck('id'))->pluck('id');
            $new->whereHas('orderdetails',function($q)use($serIDS){
                $q->whereIn('service_id',$serIDS);
            });
            $process->whereHas('orderdetails',function($q)use($serIDS){
                $q->whereIn('service_id',$serIDS);
            });
            $end->whereHas('orderdetails',function($q)use($serIDS){
                $q->whereIn('service_id',$serIDS);
            });
        }
        $new    =   $new->latest()->paginate(6);
        $process=   $process->latest()->paginate(6);
        $end    =   $end->latest()->paginate(6);
        return response()->json([
            'status'  => true,
            'new'     => OrderResource::collection($new)->response()->getData(true),
            'process' => OrderResource::collection($process)->response()->getData(true),
            'end'     => OrderResource::collection($end)->response()->getData(true),
        ], 200);
    }
    public function getAvaEmployee(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'seID'      =>'required|exists:services,id',
            'roomID'    =>'required|exists:rooms,id',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $service=Service::findOrFail($request->seID);
        $room=Room::findOrFail($request->roomID);
        $employeeIDS=Resemployee::where('hotel_id',$room->hotel_id)->where('unit_id',$service->unit_id)->where('from_room_id','<=',$room->code)->where('to_room_id','>=',$room->code)->pluck('employee_id');
        if(count($employeeIDS)<=0)
        {
                return response()->json([
                    'status'  => false,
                    'message' => __('site.no_records'),
                ], 404);
        }
        $avaEmployeeOrder=array();
        foreach($employeeIDS as $empID)
        {
            $orederC=Order::where('hotel_id',$room->hotel_id)->whereIn('status',['new','process'])->where('employee_id',$empID)->whereDate('created_at',date('Y-m-d'))->where('actual_end_time',null)->count() ?? 0;
            $emp=Employee::where('block','unblocked')->find($empID);
            if(!empty($emp)){
                $avaEmployeeOrder+=[$empID=>$orederC];
            }
        }
        if(count($avaEmployeeOrder)<=0)
        {
                return response()->json([
                    'status'  => false,
                    'message' => __('site.no_records'),
                ], 404);
        }
        $employees=array();
        foreach($avaEmployeeOrder as $index=>$val)
        {
            $emp=Employee::find($index);
            $emp->orderNum=$val;
            array_push($employees,$emp);
        }
        return response()->json([
            'status'  => true,
            'employees' => EmployeeCustomResource::collection($employees),
        ], 200);
    }


    public function changeStatusToProcess(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'order_id'=>'required|exists:orders,id',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $order=Order::where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)
                ->where('status','new')->find($request->order_id);
        if(empty($order)){
            return response()->json([
                'status'    =>false,
                'message'   =>__('site.No_Project'),
            ]);
        }
        $order->update(['status'=>'process']);
        //NOTIFICATION
        //employee
            $hotel=Hotel::find($supervisor->hotel_id);
            if($order->employee_id != null)
            {
                $this->sendNotification($hotel->translate('ar')->name,$hotel->translate('en')->name,'تم تغير حالة الطلب الى جارى التنفيذ','The status of The Order has been changed to Executing',$order->employee_id,$order->id,'emp');
            }
        //END NOTIFICATION
        return response()->json([
            'status'    =>true,
            'message'   =>__('site.update_status_successfully'),
        ]);
    }
    public function changeStatusToEnd(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'order_id'=>'required|exists:orders,id',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $order=Order::where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)
                ->where('status','process')->find($request->order_id);
        if(empty($order)){
            return response()->json([
                'status'    =>false,
                'message'   =>__('site.No_Project'),
            ]);
        }
        $order->update(['status'=>'end','actual_end_time'=>date('Y-m-d h:i:s')]);
        //NOTIFICATION
            //employee
            $hotel=Hotel::find($supervisor->hotel_id);
            if($order->employee_id != null)
            {
                $this->sendNotification($hotel->translate('ar')->name,$hotel->translate('en')->name,'تم تغير حالة الطلب الى إنهاء','The status of The Order has been changed to Ending',$order->employee_id,$order->id,'emp');
            }
        //END NOTIFICATION
        return response()->json([
            'status'    =>true,
            'message'   =>__('site.update_status_successfully'),
        ]);
    }


    public function changeEmployeeStatus(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'employee_id'=>'required|exists:employees,id',
        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $emp=Employee::where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)->find($request->employee_id);
        if(empty($emp)){
            return response()->json([
                'status'    =>false,
                'message'   =>__('site.no_records'),
            ]);
        }
        $hotel=Hotel::find($emp->hotel_id);
        if($emp->block=='block')
        {
            $emp->update(['block'=>'unblocked']);
            //NOTIFICATION
                $this->sendNotification($hotel->translate('ar')->name,$hotel->translate('en')->name,'تم تغيير حالتك إلى نشط','Your Status  changed to Active',$emp->id,null,'emp');
            //END NOTIFICATION
        }else{
            $emp->update(['block'=>'block']);
            //NOTIFICATION
                $this->sendNotification($hotel->translate('ar')->name,$hotel->translate('en')->name,'تم تغيير حالتك إلى غير نشط','Your Status  changed to unActive',$emp->id,null,'emp');
            //END NOTIFICATION
        }
        return response()->json([
            'status'    =>true,
            'message'   =>__('site.update_status_successfully'),
        ]);
    }
    public function AssignEmployeeToOrder(Request $request)
    {
        try {
            if (! $supervisor = auth('supervisor')->user()) {
                return response()->json([
                    'status'  => false,
                    'message' =>__('site.user_not_found'),
                ], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_expired'),
            ], 404);

        } catch (TokenInvalidException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_invalid'),
            ], 404);

        } catch (JWTException $e) {

            return response()->json([
                'status'  => false,
                'message' => __('site.token_absent'),
            ], 404);
        }
        $validator=Validator::make($request->all(),[
            'order_id'      =>'required|exists:orders,id',
            'employee_id'   =>'required|exists:employees,id',

        ]);
        if($validator->fails())
        {
            return response()->json([
                'status'    =>false,
                'message'   =>$validator->errors(),
            ]);
        }
        $order=Order::where('hotel_id',$supervisor->hotel_id)->where('supervisor_id',$supervisor->id)
            ->where('status','new')->find($request->order_id);
        if(empty($order)){
            return response()->json([
                'status'    =>false,
                'message'   =>__('site.No_Project'),
            ]);
        }
        $order->update(['employee_id'=>$request->employee_id]);
        //NOTIFICATION
            $hotel=Hotel::find($order->hotel_id);
            $this->sendNotification($hotel->translate('ar')->name,$hotel->translate('en')->name,'طلب جديد','New Order',$order->employee_id,$order->id,'emp');
        //END NOTIFICATION
        return response()->json([
            'status'    =>true,
            'message'   =>__('site.update_Employee_successfully'),
        ]);
    }

}
