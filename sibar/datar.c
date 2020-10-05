#include <stdio.h>
#include <malloc.h>
#include <string.h>
#include <process.h>
#include <stdlib.h>

int lines();
void detect(int *move, int *bre, int len);

int main(void)
{
    FILE *fp;
    int *move = NULL, *bre = NULL;
    char shim;
    int i = 0;

    if ((fp = fopen("data.txt", "rt")) == NULL)
    {
        printf("파일을 열지 못함.\n");
        return 0;
    }
    int len = lines() + 1;
    move = malloc(sizeof(int) * len);
    bre = malloc(sizeof(int) * len);
    for (i = 0; i < len; i++)
    {
        fscanf(fp, "%d %c %d", &move[i], &shim, &bre[i]);
        printf("%d %c %d\n", move[i], shim, bre[i]);
        if (move[i] == 0 && bre[i] == 0)
        {
            system("python smss.py");
            break;
        }
    }

    fclose(fp);
    return 0;
}

int lines()
{
    FILE *ffp;
    int line = 0;
    char c;
    ffp = fopen("data.txt", "rt");

    while ((c = fgetc(ffp)) != EOF)
    {
        if (c == '\n')
            line++;
    }
    fclose(ffp);
    return (line);
}
