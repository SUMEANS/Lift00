#include <stdio.h>
#include <malloc.h>
#include <string.h>

#define PRODUCT 3
#define PRODUCT_OF 7

typedef struct
{
	char name[50];
	int price;
}macstruct;

static macstruct donald[PRODUCT][PRODUCT_OF] = {
	{
	{"빅맥" , 4600},
	{"빅맥 베이컨" , 5000},
	{"1955버거" , 5700},
	{"맥치킨" , 4600},
	{"맥스파이시 상하이버거" , 5000},
	{"맥치킨 모짜렐라" , 5300},
	{"불고기버거" , 4000}
	},


	{
	{"맥스파이시 상하이 치킨 스낵랩" , 1200},
	{"애플파이" , 500},
	{"맥너겟" , 600},
	{"후렌치 후라이" , 1000},
	{"치즈스틱" , 700},
	{"치킨텐더" , 700},
	{"해쉬 브라운" , 900}
	},


	{
	{"배 칠러" , 1200},
	{"자두 칠러" , 1200},
	{"카페라떼" , 3000},
	{"아이스 카페라떼" , 3200},
	{"아이스 아메리카노" , 3200},
	{"에스프레소" , 3000},
	{"디카페인 아이스 아메리카노" , 3500}
	}


};

static int sum = 0;



int MainMenu();
void BurMenu(int mainmenu);
void SideMenu(int mainmenu);
void CoffeeMenu(int mainmenu);




int main(void) {
	int mainmenu;

	void (*mac[PRODUCT])(int) = {
		BurMenu,SideMenu,CoffeeMenu
	};


	while (1) {

		mainmenu = MainMenu();

		if (mainmenu >= 0 && mainmenu < 3)
			mac[mainmenu](mainmenu);


		else if (mainmenu == 3)
			break;
	}

	printf("총 주문금액: %d\n", sum);

	return 0;
}



int MainMenu() {
	int menu;


	printf("-------------------------------------------------\n");
	printf("0번 버거 메뉴\n");
	printf("1번 사이드 메뉴\n");
	printf("2번 음료 메뉴\n");
	printf("3번 종료\n");
	printf("-------------------------------------------------\n");
	printf("입력하시오 : ");
	scanf("%d", &menu);

	return menu;
}

void BurMenu(int mainmenu) {

	int *burmenu= NULL , num;
	int i;


	printf("-------------------------------------------------\n");
	printf("0번 빅맥                           | 4600원\n");
	printf("1번 빅맥 베이컨                    | 5000원\n");
	printf("2번 1955버거                       | 5700원\n");
	printf("3번 맥치킨                         | 4600원\n");
	printf("4번 맥스파이시 상하이버거          | 5000원\n");
	printf("5번 맥치킨 모짜렐라                | 5300원\n");
	printf("6번 불고기 버거                    | 4000원\n");
	printf("-------------------------------------------------\n");

	printf("수량을 입력하시오: \n");
	scanf("%d", &num);

	burmenu =malloc(sizeof(int) * num);

	for (i = 0; i < num; i++)
	{
		printf("입력하시오 : ");
		scanf("%d", &burmenu[i]);

		printf("%s %d\n", donald[mainmenu][burmenu[i]].name, donald[mainmenu][burmenu[i]].price);

		sum += donald[mainmenu][burmenu[i]].price;
	}
	free(burmenu);

}

void SideMenu(int mainmenu) {
	int sidemenu, num;
	int i;

	printf("---------------------------------------------------------\n");
	printf("0번 맥스파이시 상하이 치킨 스낵랩		|  1200원\n");
	printf("1번 애플파이					|  500원\n");
	printf("2번 맥너겟					|  600원\n");
	printf("3번 후렌치 후라이				|  1000원\n");
	printf("4번 치즈스틱					|  700원\n");
	printf("5번 치킨텐더					|  700원\n");
	printf("6번 해쉬 브라운					|  900원\n");
	printf("--------------------------------------------------------\n");

	printf("수량을 입력하시오: \n");
	scanf("%d", &num);
	for (i = 0; i < num; i++)
	{
		printf("%d. 입력하시오 : ", num);
		scanf("%d", &sidemenu);

		printf("%s %d\n", donald[mainmenu][sidemenu].name, donald[mainmenu][sidemenu].price);

		sum += donald[mainmenu][sidemenu].price;
	}
}


void CoffeeMenu(int mainmenu) {
	int coffeemenu, num;
	int i;


	printf("-------------------------------------------------\n");
	printf("0번 배 칠러				|  1200원\n");
	printf("1번 자두 칠러				|  1200원\n");
	printf("2번 카페라떼				|  3000원\n");
	printf("3번 아이스 카페라떼			|  3200원\n");
	printf("4번 아이스 아메리카노			|  3200원\n");
	printf("5번 에스프레소				|  3000원\n");
	printf("6번 디카페인 아이스 아메리카노		|  3500원\n");
	printf("-------------------------------------------------\n");

	printf("수량을 입력하시오: \n");
	scanf("%d", &num);
	for (i = 0; i < num; i++)
	{
		printf("%d. 입력하시오 : ", num);
		scanf("%d", &coffeemenu);

		printf("%s %d\n", donald[mainmenu][coffeemenu].name, donald[mainmenu][coffeemenu].price);

		sum += donald[mainmenu][coffeemenu].price;
	}
}