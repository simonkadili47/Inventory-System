use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->longText('product_description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key
            $table->integer('quantity')->nullable();
            $table->decimal('buying_price', 10, 2)->nullable();
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->decimal('total_price', 10, 2)->nullable();
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
