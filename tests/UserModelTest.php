<?php

class UserModelTest extends TestCase {

    /**
     * Test user fullname.
     *
     * @return void
     */
    public function testUserFullName() {
        $users = factory(App\Models\User::class, 5)->make();
        foreach (range(0, 4) as $index) {
            $this->assertEquals($users[$index]->name . ' ' . $users[$index]->surname, $users[$index]->fullname);
        }
    }
}
