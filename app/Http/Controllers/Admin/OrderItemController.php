<?phppublic function store(Request $request)
{
    $item = OrderItem::create([
        'order_id' => $request->order_id,
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
        'unit_price' => $request->unit_price,
        // حساب total_price مباشرةً
        'total_price' => $request->quantity * $request->unit_price,
    ]);

    return redirect()->back()->with('success', 'Order item added successfully.');
}
public function update(Request $request, $id)
{
    $item = OrderItem::findOrFail($id);

    $item->update([
        'quantity' => $request->quantity,
        'unit_price' => $request->unit_price,
        // تحديث total_price بناءً على القيم الجديدة
        'total_price' => $request->quantity * $request->unit_price,
    ]);

    return redirect()->back()->with('success', 'Order item updated successfully.');
}
